
function deleteBtn(){
    if(window.confirm('本当に削除しますか？')){
        return true;
    }else{
        window.alert('キャンセル');
        return false;
    }
}