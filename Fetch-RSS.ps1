[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12
$scriptpath = $MyInvocation.MyCommand.Path
$dir = Split-Path $scriptpath

foreach ($feed in (Get-Content -path "$dir\feeds.txt")) {
    $item = $feed.Split(',').TrimEnd()
    Write-host "Grabbing RRS from $($item[0])"
    invoke-webrequest -uri $item[1] -OutFile "$dir\feeds\$($item[0]).XML" -verbose -UseBasicParsing 
}
exit