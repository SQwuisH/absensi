function clock() {
    var datetime = new Date();
    var jam = datetime.getHours();
    var menit = datetime.getMinutes();

    Number.prototype.pad = function(digits) {
        for (var n = this.toString(); n.length < digits; n = 0 + n);
        return n;
    }

    document.getElementById("j").innerHTML = jam.pad(2);
    document.getElementById("m").innerHTML = menit.pad(2);

    document.getElementById("jj").innerHTML = jam.pad(2);
    document.getElementById("mm").innerHTML = menit.pad(2);
}
setInterval(clock, 10);
