const tableData = $('#result-table > tbody'); // тело таблицы
const xCheckBoxes = $('#coordinates-form .x-checkbox'); // чекбоксы 

const yInput = $('#Y-text');
const rInput = $('#R-text');

function checkboxSelected() { // проверка, есть ли активный чекбокс
    let isChecked = false;
    let el = $('#coordinates-form .x-checkbox:checked');
    if (el.length) {
        isChecked = el.prop('checked');
    }
    return isChecked;
}

function validateInput(input, a, b) { // проверка на валидность для текстовых инпутов
    if (input.val() >= a && input.val() <= b) {
        return true;
    }
    
    return false;
}

function validateAll() {
    return checkboxSelected() && validateInput(yInput, -5, 5) && validateInput(rInput, 1, 4);
}



xCheckBoxes.click((event) => { // код для выбора только одного чекбокса
    xCheckBoxes.prop('checked', false);
    $(event.target).prop('checked', true);
});


$(document).ready(function () {
    $.ajax({
        url: 'php/load.php',
        method: 'GET', 
        dataType: 'html', 
        success: function(data) {
            tableData.html(data);
        }, 
        error: function(error) {
            console.log(error);
        }
    });
});



$('#clear-button').click(() => {
    $.ajax({
        url: 'php/clear.php', 
        method: 'GET', 
        dataType: 'html', 
        success: function(data) {
            tableData.html(data);
        }, 
        error: function(error) {
            console.log(error)
        }
    });
});

$('#coordinates-form').on('submit', function(event) {
    event.preventDefault(); 
    $('.tip').remove();
    if (!validateAll()) {
        console.log('data not valid');
        console.log($('#coordinates-form .x-checkbox:checked'));
        if ($('#coordinates-form .x-checkbox:checked').length === 0) {
            $('.form .x-checkboxes').append('<div class="tip">Выберете X</div>');
        }

        if (!validateInput(yInput, -5, 5)) {
            yInput.after('<div class="tip">Y должен быть от -5 до 5</div>');
        }
        if (!validateInput(rInput, 1, 4)) {
            rInput.after('<div class="tip">R должен быть от 1 до 4</div>');
        }
        return;
    } else {
        console.log('data valid');
    }
    let x = $('#coordinates-form .x-checkbox:checked').val();
    console.log(x + ' ' + yInput.val() + ' ' + rInput.val());
    $.ajax({
        url: 'php/submit.php',
        method: 'GET',
        dataType: 'html',
        data: {'x': x, 'y': yInput.val(), 'r':rInput.val()},
        success: function(data) {
            tableData.html(data)
        }, 
        error: function(error) {
            console.log(error)
        }
    });
});

