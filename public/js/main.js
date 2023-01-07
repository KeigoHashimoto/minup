
function deleteBtn(){
    if(window.confirm('本当に削除しますか？')){
        return true;
    }else{
        window.alert('キャンセルしました。');
        return false;
    }
};

const taskBtn = document.getElementById('task-icon');
const task = document.getElementById('tasks-form');
const filter = document.querySelectorAll('.filter');

const editBtn = document.getElementById('edit-btn');
const editContent = document.getElementById('expense-edit');

function modal(btn,content,filter){
    $(btn).on('click',() => {
        $(content).toggle();
        $(filter).fadeIn();
    })
}

function modalClose(filter,content){
    $(filter).on('click',() => {
        $(content).fadeOut();
        $(filter).fadeOut();
    })
}

// タスク作成画面のモーダル
modal(taskBtn,task,filter);
modalClose(filter,task);

// 出費の編集モーダル
modal(editBtn,editContent,filter);
modalClose(filter,editContent);

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