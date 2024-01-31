(function () {
    darkModeStyleSet();
})();

function darkMode() {
    if (localStorage.getItem('ie-dark-mode') && localStorage.getItem('ie-dark-mode') === 'true') {
        localStorage.setItem('ie-dark-mode', 'false');
    } else {
        localStorage.setItem('ie-dark-mode', 'true');
    }
    darkModeStyleSet();
}

function darkModeStyleSet() {
    const body = document.querySelector('body');
    if (localStorage.getItem('ie-dark-mode') && localStorage.getItem('ie-dark-mode') === 'true') {
        body.classList.add('dark-mode');
    } else {
        body.classList.remove('dark-mode');
    }
}

function carousel(el, dir, slides) {
    let container = el.parentElement;
    let carouselItem = container.querySelector('.carousel-item');
    let slider = container.querySelector('.slider');
    let sliderStyle = window.getComputedStyle(slider);
    let carouselStyle = window.getComputedStyle(carouselItem);
    let size = parseInt(carouselStyle.width) +  parseInt(carouselStyle.marginRight) + parseInt(carouselStyle.marginLeft);
    let margin = isNaN(parseInt(slider.style.marginRight)) ? 0 : parseInt(slider.style.marginRight);
    let maxMargin = (parseInt(sliderStyle.width) - (4 * size)) * -1;

    if (dir > 0) {
        margin += size * slides;
    } else {
        margin -= size * slides;
    }
    if (margin >= 0) {
        margin = 0;
        container.querySelector('.control.left').classList.add('disable')
    } else {
        container.querySelector('.control.left').classList.remove('disable')
    }
    if (margin <= maxMargin) {
        margin = maxMargin;
        container.querySelector('.control.right').classList.add('disable')
    } else {
        container.querySelector('.control.right').classList.remove('disable')
    }
    slider.style.marginRight = margin + 'px';
}

function validateForm(form, event) {
    form.querySelectorAll('input').forEach((input) => {
        input.classList.remove('invalid');
    })

    let hasError= false;
    if (form.email && !(form.email.value.length >= 5 && form.email.value.match(/^[a-z][a-z0-9._]*@[a-z0-9._]+.[a-z]+$/))) {
        addError(form.email);
        hasError = true;
    }
    if (form.name && !(form.name.value.length >= 3 && form.name.value.match(/^[A-Za-z ]+$/))) {
        addError(form.name);
        hasError = true;
    }
    if (form.phone && form.phone.value.length !== 0 && !(form.phone.value.length === 11 && form.phone.value.match(/^09[0-9]+$/))) {
        addError(form.phone);
        hasError = true;
    }
    if (form.password && !(form.password.value.length >= 6)) {
        addError(form.password);
        hasError = true;
    }
    if (form.repeat_password && !(form.repeat_password.value === form.password.value)) {
        addError(form.repeat_password);
        hasError = true;
    }

    if (hasError) {
        event.preventDefault();
    } else {
        form.querySelectorAll('input').forEach((input) => {
            input.classList.add('valid');
        })
    }
    function addError(el) {
        el.classList.add('invalid')
        console.log('invalid ' + el.name)
    }
}

function showTourleader(id, data, name) {
    let table = JSON.parse(data);
    const section = document.querySelector('#reserve_tourleaders');

    //setup reserve subsection
    const tableEL = section.querySelector('.calender-table');
    const leaderNameEL = section.querySelector('form.reserve-form h4 > span.leader-name');
    const reserveFormEL = section.querySelector('form.reserve-form');

    leaderNameEL.innerHTML = name;

    reserveFormEL.action = reserveFormEL.action.replace('-leaderId-', id);

    let tableHTML = '';
    table.map((row, rowidx) => {
        tableHTML += '<tr>';
        tableHTML += '<td>' + row.day + '</td>';
        row.times.map((col) => {
            if (col.type === 'reservable') {
                tableHTML += '<td class="free">آزاد</td>';
            } else {
                tableHTML += '<td class="reserved">رزرو</td>';
            }
        });
        tableHTML += '</tr>';
    });

    tableEL.querySelector('tbody').innerHTML = tableHTML;

    //TODO: setup comment subsection
    const comLeaderNameEL = section.querySelector('#reserve_tourleaders .section.comments span.leader-name');
    const comReserveFormEL = section.querySelector('#reserve_tourleaders .section.comments form');

    comLeaderNameEL.innerHTML = name;

    comReserveFormEL.action = comReserveFormEL.action.replace('-leaderId-', id);

    // show section
    let scrollHeights = 0;
    for (const child of section.children) {
        scrollHeights += parseInt(child.scrollHeight) ?? 0;
    }
    section.style.height = 'calc(' + scrollHeights + 'px + 2 * 3rem)';
    section.style.paddingBottom = '3rem';
    section.style.paddingTop = '3rem';
}

function selectCalender(date, time) {
    const reserveFormEL = document.querySelector('#reserve_tourleaders form.reserve-form');

    reserveFormEL.date.value = date;
    reserveFormEL.time.value = time;

}
