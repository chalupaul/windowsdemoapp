Step 1: get tower's key in all linux instances.

Step 2: run these commands on all windows instances (as local Administrator):
winrm quickconfig -q
winrm set winrm/config/service/auth @{Basic="true"}

Step 2: set up variables for the inventory in tower:
app_domain: windowsdemo.com
dbname: windowsdemo
dbusername: windowsdemo
dbpassword: secrete
db_vip: 166.78.241.74
web_vip: 192.237.188.212
app_vip: 192.237.180.58

Step 3: set up groups in tower:
app
db
frontend

Step 4: Windows app group in tower needs the following variables:
ansible_connection: winrm
ansible_winrm_transport: basic
ansible_winrm_server_cert_validation: ignore

Step 5: add the following variables on all windows instances:
ansible_user: Administrator
ansible_password: **redacted**
