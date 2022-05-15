function ChangeToKeyword() {
    let keyword;
    keyword = document.getElementById("input-name").value;
    keyword = keyword.toLowerCase();
    // Đổi ký tự thành không dấu.
    keyword = keyword.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
    keyword = keyword.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
    keyword = keyword.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
    keyword = keyword.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
    keyword = keyword.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
    keyword = keyword.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
    keyword = keyword.replace(/đ/gi, "d");
    //Xóa các ký tự đặt biệt
    keyword = keyword.replace(
        /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
        ""
    );
    //Đổi khoảng trắng thành ký tự gạch ngang
    keyword = keyword.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    keyword = keyword.replace(/\-\-\-\-\-/gi, "-");
    keyword = keyword.replace(/\-\-\-\-/gi, "-");
    keyword = keyword.replace(/\-\-\-/gi, "-");
    keyword = keyword.replace(/\-\-/gi, "-");
    //Xóa các ký tự gạch ngang ở đầu và cuối
    keyword = "@" + keyword + "@";
    keyword = keyword.replace(/\@\-|\-\@|\@/gi, "");
    //In keyword ra textbox có id “keyword”
    document.getElementById("input-keyword").value = keyword;
}
// CKEDITOR.replace("chapter-content");
