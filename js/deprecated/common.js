if (document.querySelector('.home')) {
    document.querySelector('#instafeed-load-more').addEventListener('click', function() {
        this.style.display = 'none';
        document.querySelectorAll('.instafeed-item').forEach(function(element) {
            element.style.display = 'block';
        });
    });
}

window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'G-V5HP7Y1MMT');

var chatbox = document.getElementById('fb-customer-chat');
chatbox.setAttribute("page_id", "1696473387271743");
chatbox.setAttribute("attribution", "biz_inbox");

window.fbAsyncInit = function() {
    FB.init({
        xfbml: true,
        version: 'v12.0'
    });
};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/el_GR/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));