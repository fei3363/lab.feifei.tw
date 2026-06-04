from flask import Flask,request

app = Flask(__name__)


@app.route('/',methods=["GET","POST","ME0000W"])
def hello():
    if request.method == "ME0000W":
        return "Flag{U_R_Cooooool_me0w_me0w!!!}"
    if request.method == "GET":
        return "Try other method!"
    else:
        return "Nope!"

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
