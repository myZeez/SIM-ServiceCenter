Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

Set-Location "e:\SKRIP v2\AdministrasiCellcom"

# Ensure seeded test users exist
php artisan db:seed --class=Database\\Seeders\\AdminUserSeeder | Out-Null

$baseUrl = 'http://127.0.0.1:8090'

function Invoke-TestRequest {
    param(
        [Parameter(Mandatory = $true)][string]$Name,
        [Parameter(Mandatory = $true)][string]$Method,
        [Parameter(Mandatory = $true)][string]$Url,
        [hashtable]$Body,
        [Microsoft.PowerShell.Commands.WebRequestSession]$Session,
        [int]$ExpectedStatus,
        [string]$ExpectedFinalUrlContains = ''
    )

    $status = -1
    $finalUrl = ''
    $note = ''

    try {
        if ($Method -eq 'GET') {
            $resp = Invoke-WebRequest -Uri $Url -Method GET -WebSession $Session -UseBasicParsing
        } else {
            $resp = Invoke-WebRequest -Uri $Url -Method POST -WebSession $Session -Body $Body -ContentType 'application/x-www-form-urlencoded' -UseBasicParsing
        }

        $status = [int]$resp.StatusCode
        if ($resp.BaseResponse -and $resp.BaseResponse.ResponseUri) {
            $finalUrl = [string]$resp.BaseResponse.ResponseUri.AbsoluteUri
        }
    }
    catch {
        $hasResponse = $null -ne $_.Exception -and $_.Exception.PSObject.Properties.Name -contains 'Response' -and $null -ne $_.Exception.Response
        if ($hasResponse) {
            $status = [int]$_.Exception.Response.StatusCode
            if ($_.Exception.Response.ResponseUri) {
                $finalUrl = [string]$_.Exception.Response.ResponseUri.AbsoluteUri
            }
        } else {
            $note = $_.Exception.Message
        }
    }

    $pass = ($status -eq $ExpectedStatus)
    if ($pass -and $ExpectedFinalUrlContains -ne '') {
        $pass = $finalUrl -like "*$ExpectedFinalUrlContains*"
    }

    [PSCustomObject]@{
        Timestamp = (Get-Date).ToString('yyyy-MM-dd HH:mm:ss')
        TestCase = $Name
        Method = $Method
        Url = $Url
        ExpectedStatus = $ExpectedStatus
        ActualStatus = $status
        ExpectedLocation = $ExpectedFinalUrlContains
        ActualLocation = $finalUrl
        Status = if ($pass) { 'PASS' } else { 'FAIL' }
        Note = $note
    }
}

function Get-CsrfToken {
    param(
        [Parameter(Mandatory = $true)][string]$Url,
        [Parameter(Mandatory = $true)][Microsoft.PowerShell.Commands.WebRequestSession]$Session
    )

    $page = Invoke-WebRequest -Uri $Url -WebSession $Session -UseBasicParsing
    $m = [regex]::Match($page.Content, 'name="_token" value="([^"]+)"')
    if (-not $m.Success) {
        throw "CSRF token not found at $Url"
    }

    return $m.Groups[1].Value
}

$results = @()

# Public & unauthorized tests
$results += Invoke-TestRequest -Name 'Public diagnosis page accessible' -Method 'GET' -Url "$baseUrl/diagnosis" -ExpectedStatus 200
$results += Invoke-TestRequest -Name 'Public cek-status page accessible' -Method 'GET' -Url "$baseUrl/cek-status" -ExpectedStatus 200
$results += Invoke-TestRequest -Name 'Dashboard blocked for guest' -Method 'GET' -Url "$baseUrl/dashboard" -ExpectedStatus 200 -ExpectedFinalUrlContains '/login'
$results += Invoke-TestRequest -Name 'Super admin dashboard blocked for guest' -Method 'GET' -Url "$baseUrl/super-admin/dashboard" -ExpectedStatus 200 -ExpectedFinalUrlContains '/login'

# Admin auth tests
$guestSession = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$tokenGuest = Get-CsrfToken -Url "$baseUrl/login" -Session $guestSession
$results += Invoke-TestRequest -Name 'Login fail with wrong password' -Method 'POST' -Url "$baseUrl/login" -Session $guestSession -Body @{ _token = $tokenGuest; email = 'admin2@cellcom.com'; password = 'salah123' } -ExpectedStatus 200 -ExpectedFinalUrlContains '/login'

$adminSession = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$tokenAdmin = Get-CsrfToken -Url "$baseUrl/login" -Session $adminSession
$results += Invoke-TestRequest -Name 'Login success for admin' -Method 'POST' -Url "$baseUrl/login" -Session $adminSession -Body @{ _token = $tokenAdmin; email = 'admin2@cellcom.com'; password = 'password' } -ExpectedStatus 200 -ExpectedFinalUrlContains '/dashboard'
$results += Invoke-TestRequest -Name 'Admin can access dashboard' -Method 'GET' -Url "$baseUrl/dashboard" -Session $adminSession -ExpectedStatus 200
$results += Invoke-TestRequest -Name 'Admin blocked from super-admin dashboard' -Method 'GET' -Url "$baseUrl/super-admin/dashboard" -Session $adminSession -ExpectedStatus 403

# Super admin auth tests
$saSession = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$tokenSa = Get-CsrfToken -Url "$baseUrl/super-admin/login" -Session $saSession
$results += Invoke-TestRequest -Name 'Login success for super admin' -Method 'POST' -Url "$baseUrl/super-admin/login" -Session $saSession -Body @{ _token = $tokenSa; email = 'admin@cellcom.com'; password = 'password' } -ExpectedStatus 200 -ExpectedFinalUrlContains '/super-admin/dashboard'
$results += Invoke-TestRequest -Name 'Super admin can access super dashboard' -Method 'GET' -Url "$baseUrl/super-admin/dashboard" -Session $saSession -ExpectedStatus 200
$results += Invoke-TestRequest -Name 'Super admin blocked from admin dashboard' -Method 'GET' -Url "$baseUrl/dashboard" -Session $saSession -ExpectedStatus 403

$resultsPathJson = "e:\SKRIP v2\AdministrasiCellcom\storage\logs\bab4_blackbox_results.json"
$resultsPathCsv = "e:\SKRIP v2\AdministrasiCellcom\storage\logs\bab4_blackbox_results.csv"

$results | ConvertTo-Json -Depth 4 | Set-Content -Path $resultsPathJson -Encoding UTF8
$results | Export-Csv -Path $resultsPathCsv -NoTypeInformation -Encoding UTF8

$passCount = @($results | Where-Object { $_.Status -eq 'PASS' }).Count
$failCount = @($results | Where-Object { $_.Status -eq 'FAIL' }).Count

"=== BAB 4 BLACK-BOX TEST SUMMARY ==="
"Total: $($results.Count) | PASS: $passCount | FAIL: $failCount"
$results | Format-Table TestCase, ExpectedStatus, ActualStatus, ExpectedLocation, ActualLocation, Status -AutoSize
"Saved JSON: $resultsPathJson"
"Saved CSV : $resultsPathCsv"
