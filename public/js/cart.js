const numberFormat = (number, point) => {
    return number.toLocaleString('th-TH', {minimumFractionDigits: point});
}

const swapZoomTotalPrice = () => {
    document.querySelectorAll('.cart_total_price').forEach((item) => {
        item.classList.remove('zoom');
        setTimeout(() => { item.classList.add('zoom'); }, 0);
    });
}


var data_cart = [];


const getDataCart = () => {
    let tmpInnerTbodyCart = '';
    let tmpInnerTbodyCartReport = '';

    data_cart = JSON.parse(localStorage.getItem('data_cart')) || [];
    document.querySelectorAll('.jsonDataCart').forEach((item) => {
        item.value = localStorage.getItem('data_cart');
    });
    
    if (data_cart.length) {
        $no = 0;
        data_cart.forEach((item, index) => {
            $no++;

            tmpInnerTbodyCart += `
                <tr>
                    <td><img src="${ window.location.origin + '/' + item.image_url }" height="36"></td>
                    <td>${ item.code }</td>
                    <td>${ item.name }</td>
                    <td>
                        <input onkeyup="updateQty('${ item.id }', this)" type="text" class="form-control" value="${ item.qty }">
                    </td>
                    <td>${ numberFormat(item.price, 2) }</td>
                    <td>
                        <a  href="#" onclick="removeItemCart('${ item.id }')" 
                            class="btnDelItemCart btn btn-danger">
                                <i class="fa fa-times"></i>
                        </a>
                    </td>
                </tr>
            `;

            tmpInnerTbodyCartReport += `
                <tr>
                    <td>${ $no }</td>
                    <td>${ item.name }</td>
                    <td>${ numberFormat(item.price, 2) }</td>
                    <td>${ item.qty }</td>
                    <td>${ numberFormat(item.price * item.qty) }</td>
                </tr>
            `

        });
    } else {
        tmpInnerTbodyCart += `
            <tr>
                <td colspan="6" class="text-center">No data</td>
            </tr>
        `;
    }


    // CARD TABLE BODY ORIGINAL
    document.querySelectorAll('.cart_tbody').forEach((item) => {
        item.innerHTML = tmpInnerTbodyCart;
    });

    // CARD TABLE BODY ON REPORT
    document.querySelectorAll('.cart_tbody_report').forEach((item) => {
        item.innerHTML = tmpInnerTbodyCartReport;
    });

    document.querySelectorAll('.cart_total_price').forEach((item) => {
        item.innerHTML = numberFormat(data_cart.reduce((total, item) => total + (item.price * item.qty), 0));
    });

    document.querySelectorAll('.cart_total_item').forEach((item) => {
        // item.innerHTML = data_cart.reduce((total, item) => total + item.qty, 0);
        item.innerHTML = numberFormat(data_cart ? data_cart.length : 0);
    });
    
    console.log(data_cart);
}


const addToCart = (element) => {
    let item = JSON.parse(element.parentNode.querySelector('.valueItem').value);
    data_cart = JSON.parse(localStorage.getItem('data_cart')) || [];

    let index = data_cart.findIndex(item_cart => item_cart.id === item.id);
    if (index !== -1) {
        data_cart[index].qty += 1;
    } else {
        item.qty = 1;
        data_cart.push(item);
    }
    localStorage.setItem('data_cart', JSON.stringify(data_cart));

    // getDataCart();
    window.location.href = window.location.origin + '/cart/view';
}


const updateQty = (id, target) => {

    if (target.value === '') return;
    if (isNaN(target.value)) {
        alert('โปรดกรอกข้อมูลเป็นตัวเลข');
        target.value = parseInt(target.value);
        return;
    };
    
    data_cart = JSON.parse(localStorage.getItem('data_cart')) || [];
    
    let index = data_cart.findIndex(item_cart => item_cart.id === parseInt(id));
    
    if (parseInt(target.value) === 0) {
        removeItemCart(id);
        return;
    }

    data_cart[index].qty = parseInt(target.value);
    localStorage.setItem('data_cart', JSON.stringify(data_cart));
    
    getDataCart();
    swapZoomTotalPrice();
    // window.location.reload();
}


const removeItemCart = (id) => {
    data_cart = JSON.parse(localStorage.getItem('data_cart')) || [];
    
    let index = data_cart.findIndex(item_cart => item_cart.id === parseInt(id));
    data_cart.splice(index, 1);
    localStorage.setItem('data_cart', JSON.stringify(data_cart));
    
    getDataCart();
}



//- Main Call function started
getDataCart();