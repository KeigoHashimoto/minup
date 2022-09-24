
function deleteBtn(){
    if(window.confirm('本当に削除しますか？')){
        return true;
    }else{
        window.alert('キャンセル');
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