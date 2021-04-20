
// disable message button bg colour if message input is empty
function dsbl_msg_btn_if_emt() {
    var msgInptLength = document.querySelector(".message").value.length > 0;
    if (msgInptLength) {
        document.querySelector(".message-sent-btn").style = "background-color: #003cff;";
    } else {
        document.querySelector(".message-sent-btn").style = "background-color: #333333;";
    }
    
}

setInterval(dsbl_msg_btn_if_emt, 200);

dsbl_msg_btn_if_emt();