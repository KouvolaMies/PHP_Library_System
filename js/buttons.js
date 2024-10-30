function GoToIndex(){
    location.replace("index.php");
}
function GoToLogin(){
    location.replace("login.php");
}
function GoToRegister(){
    location.replace("register.php");
}
function GoToDashboard(){
    location.replace("dashboard.php");
}
function GoToAdd(){
    location.replace("add_books.php");
}
function GoToEdit(bookid){
    location.replace("edit.php?id=" + bookid);
}
function GoToAddGenres(bookid){
    location.replace("add_genres.php?id=" + bookid);
}
function GoToDelete(bookid){
    if(confirm("Are you sure you want to delete this book?") == true){
        location.replace("delete.php?id=" + bookid);
    }
}
function GoToDeleteGenre(genreid){
    if(confirm("Are you sure you want to delete this genre?") == true){
        location.replace("delete_genre.php?id=" + genreid);
    }
}
function GoToBorrow(bookid){
    location.replace("borrow.php?id=" + bookid);
}
function GoToBorrowOld(bookid){
    location.replace("borrow_old.php?id=" + bookid);
}