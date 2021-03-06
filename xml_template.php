<?php
$ecs_or_sps = trim(filter_input(INPUT_POST, 'ecs_or_sps'));
$localpart = trim(filter_input(INPUT_POST, 'localpart'));
$id = trim(filter_input(INPUT_POST, 'ku_id'));

$errors = 0;

if (!preg_match('/^ecs|sps$/', $ecs_or_sps)) {
}
else{
  if ($ecs_or_sps == 'ecs'){
    if (!preg_match('/^a0[0-9]{6,6}$/', $id)) {
    }
    if (!preg_match('/^[a-z]+\.[a-z]+\.[a-z0-9]{3,3}$/', $localpart)) {
    }
  }
  else{
    if (!preg_match('/^[a-z]+[0-9]{3,3}[a-z]+$/', $id)) {
    }
    if (!preg_match('/^[a-z]+\.[a-z]+\.[a-z0-9]{2,2}$/', $localpart)) {
    }
  }
}

if ($errors !== 0) {
	echo 'invalid values!';
	echo $errors;
  exit($errors);
}

date_default_timezone_set('Asia/Tokyo');
$log_message = date('Y-m-d h:i:s') . ' xml requested by ' . $id . "\n";
error_log($log_message, 3, 'log/users.log');

$profile_desc = 'KMC部員';
$mail_serv_desc = '部員用メール';
$mail_serv_name = 'KMC_MAIL';
$mail_serv_in_host = 'imap.kmc.gr.jp';
$mail_serv_in_port = '993';
$mail_serv_out_host = 'smtp.kmc.gr.jp';  
$mail_serv_out_port = '587';
$mail_addr_domain = '@kmc.gr.jp';
$mail_id = $id . $mail_addr_domain;
$wifi_uuid = '114286CE-40C8-4D01-90FD-D124AFD73FE2';
$cert_uuid = '39D76E78-F7C3-42F3-A4DE-EB6B9E6BA235';
$mail_uuid = '79CAE016-DB3F-4CFE-A8A6-7C95EB68652E';
$vpn_uuid =  '6A236C39-D52F-43AF-9B42-82AC84C16407';
$prof_uuid = 'F20A9232-4DFB-4C12-BEA6-AF65E2B1F12D';

header('Content-type: application/xml; chatset=utf-8');
// header('Content-type: application/x-apple-aspen-config; chatset=utf-8');
// header('Content-Disposition: attachment; filename="kyodairaku2' . $id . '.mobileconfig"');
echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>PayloadContent</key>
	<array>
		<dict>
			<key>SSID_STR</key>
			<string>KMC_ENTERPRISE</string>
			<key>HIDDEN_NETWORK</key>
			<false/>
			<key>AutoJoin</key>
			<true/>
      <key>EncryptionType</key>
			<string>WPA</string>
			<key>PayloadDescription</key>
			<string>ワイヤレス接続設定を構成します。</string>
			<key>PayloadDisplayName</key>
			<string>Wi-Fi（KMC-ENTERPRISE）</string>
			<key>PayloadIdentifier</key>
			<string>jp.gr.kmc.wifi-setting-kun</string>
			<key>PayloadOrganization</key>
			<string>Kyoto Univ, Microcomputer Club</string>
			<key>PayloadType</key>
			<string>com.apple.wifi.managed</string>
			<key>PayloadUUID</key>
			<string><?=$wifi_uuid?></string>
			<key>PayloadVersion</key>
			<integer>1</integer>
			<dict>
			  <key>UserName</key>
			  <string><?=$id?></string>
			  <key>AcceptEAPTypes</key>
			  <array>
				<integer>25</integer>
			  </array>
			  <key>PayloadCertificateAnchorUUID</key>
			  <array>
				<string><?=$cert_uuid?></string>
			  </array>
			  <key>TLSTrustedServerNames</key>
			  <array>
				<string>radius.box2.kmc.gr.jp</string>
			  </array>
			</dict>
		</dict>
		<dict>
		  <key>PayloadType</key>
		  <string>com.apple.security.pem</string>
		  <key>PayloadUUID</key>
		  <string><?=$cert_uuid?></string>
		  <key>PayloadCertificateFileName</key>
		  <string>radius.box2.kmc.gr.jp.cer</string>
		  <key>PayloadIdentifier</key>
		  <string>jp.gr.kmc.radius.www.conf-cert</string>
		  <key>PayloadDescription</key>
		  <string>KMCネットワークの安全な接続を保守する証明書です</string>
		  <key>PayloadDisplayName</key>
		  <string>KMC Radiusサーバ証明書</string>
		  <key>PayloadVersion</key>
		  <integer>1</integer>
		  <key>PayloadContent</key>
		  <data>
			MIIFDDCCA/SgAwIBAgIIMKCba8qf7zkwDQYJKoZIhvcNAQELBQAwbTELMAkGA1UE
			BhMCSlAxEDAOBgNVBAcTB0FjYWRlbWUxKjAoBgNVBAoTIU5hdGlvbmFsIEluc3Rp
			dHV0ZSBvZiBJbmZvcm1hdGljczEgMB4GA1UEAxMXTklJIE9wZW4gRG9tYWluIENB
			IC0gRzQwHhcNMTcwNjEyMDAxMzIyWhcNMTkwNzEzMDAxMzIyWjCBnTELMAkGA1UE
			BhMCSlAxEDAOBgNVBAcTB0FjYWRlbWUxGTAXBgNVBAoTEEt5b3RvIFVuaXZlcnNp
			dHkxPzA9BgNVBAsTNkt5b3RvIFVuaXZlcnNpdHkgSW50ZWdyYXRlZCBJbmZvcm1h
			dGlvbiBOZXR3b3JrIFN5c3RlbTEgMB4GA1UEAxMXcmFkLmt1aW5zLmt5b3RvLXUu
			YWMuanAwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDI45Ube02XQQsu
			IK+DVRi2KJthzVDdBQ63T3YNNY8YBZw75NhA7eSfuOyo0JzHVW5sMLVJNQW7ep/l
			FrctYWc2PUf00tVsmfz04z6NTHE7AIw7ZXG/LTXVX9RUTMZrZkdP0LjiR+aVgnXe
			q+6A+s0CadsZ6ghn3mK8IA4ZVMermVgMnZDK+wXJ5OEbSvfjcKk2UA3ZfheERepA
			qK2Iav/GBsV0HG06GYvzPDkmsRhqPlhNl8SIUmb7pn+ALSRvP9If1jYS/30/osmo
			uTmfVNGmAU5iUvbW+HbeFtTx/oVqXic97KDTkQWs/aB4SFseGAF/zQNQa/WV4wL7
			cNL2OcavAgMBAAGjggF9MIIBeTAdBgNVHSUEFjAUBggrBgEFBQcDAQYIKwYBBQUH
			AwIwHwYDVR0jBBgwFoAUGQtvOR8xAzRf5NJAHzfmjediOXwwSgYDVR0fBEMwQTA/
			oD2gO4Y5aHR0cDovL3JlcG8xLnNlY29tdHJ1c3QubmV0L3NwcGNhL25paS9vZGNh
			My9mdWxsY3JsZzQuY3JsMA4GA1UdDwEB/wQEAwIFoDAdBgNVHQ4EFgQUP2C+DZS3
			Oqrhnd27kpzxeWVrQF8wWgYDVR0gBFMwUTBPBgwrBgEEAYH8CAMCAQEwPzA9Bggr
			BgEFBQcCARYxaHR0cHM6Ly9yZXBvMS5zZWNvbXRydXN0Lm5ldC9zcGNwcC9jcHMv
			aW5kZXguaHRtbDA8BggrBgEFBQcBAQQwMC4wLAYIKwYBBQUHMAGGIGh0dHA6Ly9u
			aWlnNC5vY3NwLnNlY29tdHJ1c3QubmV0MCIGA1UdEQQbMBmCF3JhZC5rdWlucy5r
			eW90by11LmFjLmpwMA0GCSqGSIb3DQEBCwUAA4IBAQA1hjSRbHU8aMw33xBibRJ5
			J3GfHx4q2zKkopIp5rywmj60hTvRG/W5dSH+lZbLVA+7Crr22nKAV2YhHf8BmcBg
			TJEbeETdKp4WyqBwoqCXukN/hYRsqFH6eYMm8kJJFiUWKCXeC4cfjKVWdwkl3/HH
			RCe1ag5xucRpp8JqBdwp44G9WbZk6SBN1Kd22RLmpkCvrIwd6Leq8gLsMEx1M9OX
			/zwGhu8ktr6DVD/mG9RAFXRuPJtnx7VSuPzckwfO72sztCJB/01AE8EzeIGP+WKf
			qop9O/S+GxrV/ysQM48qXlKfwSojgE9BUwSTBnM2dZDwdcs5kmwRwbddLEwVZbMW
		</data>
		</dict>
		<dict>
			<key>EmailAccountDescription</key>
			<string><?=$mail_serv_name?></string>
			<key>EmailAccountType</key>
			<string>EmailTypeIMAP</string>
			<key>EmailAddress</key>
			<string><?=$localpart?><?=$mail_addr_domain?></string>
			<key>IncomingMailServerAuthentication</key>
			<string>EmailAuthPassword</string>
			<key>IncomingMailServerHostName</key>
			<string><?=$mail_serv_in_host?></string>
			<key>IncomingMailServerPortNumber</key>
			<integer><?=$mail_serv_in_port?></integer>
			<key>IncomingMailServerUseSSL</key>
			<true/>
			<key>IncomingMailServerUsername</key>
			<string><?=$mail_id?></string>
			<key>OutgoingMailServerAuthentication</key>
			<string>EmailAuthPassword</string>
			<key>OutgoingMailServerHostName</key>
			<string><?=$mail_serv_out_host?></string>
			<key>OutgoingMailServerPortNumber</key>
			<integer><?=$mail_serv_out_port?></integer>
			<key>OutgoingMailServerUseSSL</key>
			<true/>
			<key>OutgoingMailServerUsername</key>
			<string><?=$mail_id?></string>
			<key>OutgoingPasswordSameAsIncomingPassword</key>
			<true/>
			<key>PayloadDescription</key>
			<string>メールアカウントを構成します。</string>
			<key>PayloadDisplayName</key>
			<string>IMAP アカウント（<?=$mail_serv_name?>）</string>
			<key>PayloadIdentifier</key>
			<string>jp.ac.kyoto-u.iimc.rd.www.conf-kumail</string>
			<key>PayloadOrganization</key>
			<string>ICT D&amp;I Office, IIMC, Kyoto University</string>
			<key>PayloadType</key>
			<string>com.apple.mail.managed</string>
			<key>PayloadUUID</key>
			<string><?=$mail_uuid?></string>
			<key>PayloadVersion</key>
			<integer>1</integer>
			<key>PreventAppSheet</key>
			<false/>
			<key>PreventMove</key>
			<false/>
			<key>SMIMEEnabled</key>
			<false/>
		</dict>
		<dict>
			<key>EAP</key>
			<dict/>
			<key>IPv4</key>
			<dict>
				<key>OverridePrimary</key>
				<integer>1</integer>
			</dict>
			<key>IKEv2</key>
			<dict>
				<key>RemoteAddress</key>
				<string>ikev2.kuins.kyoto-u.ac.jp</string>
				<key>LocalIdentifier</key>
				<string><?=$id?></string>
				<key>RemoteIdentifier</key>
				<string>ikev2.kuins.kyoto-u.ac.jp</string>
				<key>AuthenticationMethod</key>
				<string>Certificate</string>
				<key>ExtendedAuthEnabled</key>
				<true/>
				<key>AuthName</key>
				<string><?=$id?></string>
			</dict>
			<key>PayloadDescription</key>
			<string>認証を含め、VPN 設定を構成します。</string>
			<key>PayloadDisplayName</key>
			<string>VPN（KUINS-IKEv2）</string>
			<key>PayloadIdentifier</key>
			<string>jp.ac.kyoto-u.iimc.rd.www.conf-ikev2</string>
			<key>PayloadOrganization</key>
			<string>ICT D&amp;I Office, IIMC, Kyoto University</string>
			<key>PayloadType</key>
			<string>com.apple.vpn.managed</string>
			<key>PayloadUUID</key>
			<string><?=$vpn_uuid?></string>
			<key>PayloadVersion</key>
			<integer>1</integer>
			<key>Proxies</key>
			<dict>
				<key>ProxyAutoConfigEnable</key>
				<integer>1</integer>
				<key>ProxyAutoConfigURLString</key>
				<string>http://wpad.kuins.net/proxy.pac</string>
			</dict>
			<key>UserDefinedName</key>
			<string>KUINS-IKEv2</string>
			<key>VPNType</key>
			<string>IKEv2</string>
		</dict>
	</array>
	<key>PayloadDescription</key>
	<string><?=$profile_desc?>のためのiPhone 構成プロファイルです。Wi-Fi (KUINS-Air), VPN (KUINS-IKEv2), <?=$mail_serv_desc?>の設定を一括で行います。</string>
	<key>PayloadDisplayName</key>
	<string>京大ラクラク設定ツール for iOS / OS X</string>
	<key>PayloadIdentifier</key>
	<string>jp.ac.kyoto-u.iimc.rd.www.conf</string>
	<key>PayloadOrganization</key>
	<string>ICT D&amp;I Office, IIMC, Kyoto University</string>
	<key>PayloadRemovalDisallowed</key>
	<false/>
	<key>PayloadType</key>
	<string>Configuration</string>
	<key>PayloadUUID</key>
	<string><?=$prof_uuid?></string>
	<key>PayloadVersion</key>
	<integer>1</integer>
</dict>
</plist>
