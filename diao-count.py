import json
from flask import Flask, redirect

app = Flask(__name__)

# 读取image_url.txt文件中的行数
def count_lines(file):
    with open(file, 'r') as f:
        return sum(1 for _ in f)

@app.route('/diao-count.py')
def get_diao_count():
    line_count = count_lines('image_url.txt')  # 替换为你的图片链接文件路径
    data = {'count': line_count}
    return json.dumps(data)

if __name__ == '__main__':
    app.run()