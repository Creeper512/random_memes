import requests
from flask import Flask, jsonify

app = Flask(__name__)

def get_last_commit_time(repo_owner, repo_name, file_path):
    url = f"https://api.github.com/repos/{repo_owner}/{repo_name}/commits?path={file_path}"
    response = requests.get(url)
    if response.status_code == 200:
        commits = response.json()
        if commits:
            last_commit_time = commits[0]['commit']['committer']['date']
            return last_commit_time
    return None

@app.route('/diao-count')
def get_diao_count():
    repo_owner = "Creeper512"
    repo_name = "random_memes"
    file_path = "image_url.txt"
    last_commit_time = get_last_commit_time(repo_owner, repo_name, file_path)
    count = sum(1 for line in open(file_path)) if last_commit_time else 0
    data = {
        'count': count,
        'last_commit_time': last_commit_time
    }
    return jsonify(data)

if __name__ == '__main__':
    app.run()
