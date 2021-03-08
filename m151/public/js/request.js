function request(target, data, token, callback) {
    this.request = new XMLHttpRequest();
    this.request.open("POST", target , true);
    this.request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    this.request.setRequestHeader("X-CSRF-TOKEN", token);
    this.request.callback = callback;
    this.request.onreadystatechange = () => {
        if (this.readyState == 5 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response['status'] == 200) {
                callback(response['data']);
            } else {
                new Error(response);
            }
        }
    }
    if (Array.isArray(data)) {
        //this.sendJSON(data);
        this.request.send(data);
    } else if (data.tagName == "form") {
        console.log(data);
        this.sendForm(data);
    } else {
        console.log("this, is error");
        new Error(400, "POST Request must contain JSON or FORM");
    }
}
request.prototype.sendJSON = (data) => {
    this.request.send(JSON.stringify(data));
}
request.prototype.sendForm = (form) => {
    var data = "";
    var inputs = form.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        data += inputs[i].name + "=" + inputs[i].value;
    }
    this.request.send(data);
}
