import random
from flask import Flask, redirect

app = Flask(__name__)

# 从指定链接读取图片链接列表
def load_image_links(link_file):
    with open(link_file, 'r') as file:
        return [line.strip() for line in file]

# 随机重定向到一个图片链接
@app.route('/api.py')
def redirect_to_random_image():
    image_links = load_image_links('image_url.txt')  # 替换为你的图片链接文件路径
    random_link = random.choice(image_links)
    return redirect(random_link)

# 读取image_url.txt文件中的行数
def count_lines(file):
    with open(file, 'r') as f:
        return sum(1 for _ in f)

# 访问/diao-count时返回JSON内容
@app.route('/diao-count.py')
def get_diao_count():
    line_count = count_lines('image_url.txt')  # 替换为你的图片链接文件路径
    data = {'count': line_count}
    return json.dumps(data)

if __name__ == '__main__':
    app.run()
