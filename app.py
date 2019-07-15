from flask import Flask, render_template
from flask import jsonify, session, redirect, url_for,escape,request
from flask import Flask, flash, redirect, render_template, request, session, abort
import os

app = Flask(__name__)




import os

app = Flask(__name__)




@app.route('/login', methods=['POST'])
def do_admin_login():
    if request.form['password'] == 'password' and request.form['username'] == 'admin':
        session['logged_in'] = True
    else:
        flash('wrong password!')
    return render_template('login.hml')

@app.route('/logout', methods=['GET'])
def do_admin_logout():
    session['logged_in'] = False
    return redirect(url_for('login'))

@app.route("/")
def main():
    if not session.get('logged_in'):
        return render_template('login.html')
    else:

        data = [{
          "name": "bootstrap-table",
          "commits": "10",
          "attention": "122",
          "uneven": "An extended Bootstrap table"
        },
         {
          "name": "multiple-select",
          "commits": "288",
          "attention": "20",
          "uneven": "A jQuery plugin"
        }, {
          "name": "Testing",
          "commits": "340",
          "attention": "20",
          "uneven": "For test"
        }]
        # other column settings -> http://bootstrap-table.wenzhixin.net.cn/documentation/#column-options
        columns = [
          {
            "field": "name", # which is the field's name of data key
            "title": "name", # display as the table header's name
            "sortable": True,
          },
          {
            "field": "commits",
            "title": "commits",
            "sortable": True,
          },
          {
            "field": "attention",
            "title": "attention",
            "sortable": True,
          },
          {
            "field": "uneven",
            "title": "uneven",
            "sortable": True,
          }
        ]
            #return 'Logged in as %s' % escape(session['username'])
            #return render_template('app.php')
        return render_template('index.html')

    #return render_template('index.php')




if __name__ == "__main__":
    app.secret_key = os.urandom(12)
    app.run(debug=True,host='127.0.0.1', port=5000)
