const getDateNow = () => {
    let now = new Date();
    let d = now.getDate().toString();
    let m = now.getMonth().toString();
    let y = now.getFullYear().toString();

    return [(d.length < 2 ? `0${d}` : d), (m.length < 2 ? `0${m}` : m), (y.length < 2 ? `0${y}` : y)];
}

function randomNumberString(length) {
    var result           = '';
    var characters       = '0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}


document.querySelectorAll('.datenow').forEach((item) => {
    let dateFormatTH = getDateNow(); 
    item.innerHTML = `${dateFormatTH[0]}/${dateFormatTH[1]}/${dateFormatTH[2]}`
});

document.querySelectorAll('.randomNoOrder').forEach((item) => {
    item.innerHTML = `PD${randomNumberString(7)}`
});



document.querySelectorAll('.btnLogout').forEach((item) => {
    item.addEventListener('click', () => {
        localStorage.clear();
        window.location.href = '/logout';
    })
});

