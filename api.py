import random
from flask import Flask, redirect, current_app
from flask_cors import CORS
import os

app = Flask(__name__)
CORS(app)

# 从指定链接读取图片链接列表
def load_image_links(link_file):
    file_path = os.path.join(app.root_path, link_file)
    with open(file_path, 'r') as file:
        return [line.strip() for line in file]

# 随机重定向到一个图片链接
@app.route('/api.py')
def redirect_to_random_image():
    image_links = current_app.config['image_links']
    random_link = random.choice(image_links)
    return redirect(random_link)

if __name__ == '__main__':
    app.config['image_links'] = load_image_links('image_url.txt')
    app.run()

