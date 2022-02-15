// const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)


const containData = $('#contain-data')
const rows = $$('#contain-data tr')
const inputStorage = $$('#storage input[name]')

const btnXoa = $('#storage-btn-delete')
const btnDuyet = $('#storage-btn-add')

Array.from(rows)
rows.forEach(row => {
    row.onclick=function(e) {
        for(var i = 0; i < row.cells.length - 2; ++i) {
            inputStorage[i].value = row.cells[i].innerText;
        }
        inputStorage[i].value = row.cells[i].children[0].value
        // console.log(row.cells)
        inputStorage[5].value = row.cells[5].getAttribute('value')

        if(e.target.closest('#btn-add')) {
            e.preventDefault()
            btnDuyet.click()
            console.log('duyeejt')
        }
        if(e.target.closest('#btn-delete')) {
            e.preventDefault()
            btnXoa.click()
            console.log('Baasm huy')
        }
    }
});