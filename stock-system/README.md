# Hướng dẫn triển khai hệ thống phân loại DGA botnet

Đây là tài liệu hướng dẫn chi tiết cài đặt và triển khai hệ thống DGA botnet
## Cài đặt web server của hệ thống


###Cấu hình server:

* [Apache2](https://olegkrivtsov.github.io/using-zend-framework-3-book/html/en/Appendix_A__Configuring_Web_Development_Environment/Installing_Apache__PHP_and_MySQL_in_Linux.html) - Cài đặt apache và php cho máy chủ linux
* [Zend 3 Virual host](https://olegkrivtsov.github.io/using-zend-framework-3-book/html/en/Appendix_A__Configuring_Web_Development_Environment/Installing_Apache__PHP_and_MySQL_in_Linux.html) - Cấu hình tên miền dành cho Zend 3

Cấu hình Api phân loại DGA botnet trên server:

- Python 3.6 : [Python](https://www.python.org/downloads/)
- Restful Api

Cài đặt các thư viện liên quan:

```

$ pip3 install flask flask-jsonpify flask-sqlalchemy flask-restful
$ pip3 freeze


```

Cấu hình tên miền và cổng trong file api.py:

``` python 
 app.run(host='dga.test',port='5003')
```

### Cấu hình CSDL cho hệ thống phân loại botnet DGA:

Cấu hình CSDL trong file: tool/lib/mysql.py

``` python
config = {
  'user': 'root',
  'password': '',
  'host': '127.0.0.1',
  'database': 'bkcs_ids',
  'raise_on_warnings': True,
}

```

Chạy file tool/sql.py để tự động sinh CSDL

### Mã nguồn web server: [ZendApp](https://bkcs.dynu.net/dungtt/dga_web_server)
## Cài đặt Agent của hệ thống:

### Cài đặt một số thư viện python:
```

$ pip3 install https://storage.googleapis.com/tensorflow/linux/cpu/tensorflow-0.10.0rc0-cp27-none-linux_x86_64.whl
$ pip3 install keras
$ pip3 install scapy
$ pip3 install PyQt5
$ pip3 install json
$ pip3 install urllib
$ pip3 install import requests

```

Cấu hình lại một số thông tin trong file main.py
``` python

post_response = requests.post(url='http://dga.test/getToken', data=post_data)
    
interface = 'wlp8s0' # changeme!

req = urllib.request.Request("http://dga.test:5003/dga/"+token+"/"+lineDomain)
				
```

Với Dga.test là tên miền server, wlp8s0 là tên card mạng của máy.


Cài đặt và biên dịch Agent ra file thực thi:

```
pip3 install PyInstaller
Pyinstaller --onefile main.py
```

Hoặc:

```
py -m pip install PyInstaller
py -m Pyinstaller --onefile main.py
```

Đối với window.

### Mã nguồn agent: [Agent](https://bkcs.dynu.net/dungtt/dga_agent)



