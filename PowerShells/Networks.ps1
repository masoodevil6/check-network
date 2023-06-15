class Netwok {

    $data = @()

    Netwok(){
        $this.GetNetWork();
        $this.GetListOtherNetWork();
    }

    [void]GetNetWork() {

        $netAdaps = Get-NetAdapter;
    
        if ($netAdaps -is [array]) {
            for ($i = 0; $i -lt $netAdaps.count; $i++) {
             
                $this.data += $this.GetInfoNetwork($netAdaps[$i])
            }
        }
        else {
             $this.data += $this.GetInfoNetwork($netAdaps)
        }
    
    }

    [Object]GetInfoNetwork($netAdap) {
       
        $ip = $this.GetIpFormInterfaceAlias($netAdap.Name);
        
        return @{
              mac= $netAdap.MacAddress;
              ip = $ip;
              name = $this.GetHostNemeFormIp($ip);
            }

    }

    ##---------------------------------------------------

    [void]GetListOtherNetWork() {
        $listNetWork = (Get-NetNeighbor -State Reachable )
    
        if ($listNetWork -is [array]) {
            for ($i = 0; $i -lt $listNetWork.count; $i++) {
            
                $this.data += $this.GetInfoOtherNetwork($listNetWork[$i])
            }
        }
        else {
            $this.data  += $this.GetInfoOtherNetwork($listNetWork)
        }
    }


    [Object] GetInfoOtherNetwork($itemNetWork) {
        return @{
                mac= $itemNetWork.linklayeraddress;
                ip = $itemNetWork.ipaddress;
                 name = $this.GetHostNemeFormIp($itemNetWork.ipaddress);
                }
    }



    ##---------------------------------------------------

    [string] GetIpFormInterfaceAlias($InterfaceAlias) {
        return (Get-NetIpAddress -AddressFamily IPv4 -InterfaceAlias $InterfaceAlias -PrefixOrigin Dhcp).IPAddress
    }

    [string] GetHostNemeFormIp($ip) {
        return (Resolve-DnsName -Name  $ip).NameHost
    }
}

$ints = [Netwok]::new()
$ints.data | ConvertTo-Json -Compress