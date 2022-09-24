
function deleteBtn(){
    if(window.confirm('本当に削除しますか？')){
        return true;
    }else{
        window.alert('キャンセルしました。');
        return false;
    }
}

const taskBtn = document.getElementById('task-icon');
const task = document.getElementById('tasks-form');

function dropdown(btn,content){
    $(btn).on('click',() => {
        $(content).toggle();
    })
}

dropdown(taskBtn,task);

const menuBtn = document.getElementById('nav-icon');
const menu = document.getElementById('nav-menu');

function slideInOut(btn,content){
    $(btn).on('click',() => {
        if($(content).hasClass('slideOut')){
            $(content).removeClass('slideOut');
            $(content).addClass('slideIn');
        }else{
            $(content).removeClass('slideIn');
            $(content).addClass('slideOut');
        }
    })
}

slideInOut(menuBtn,menu);