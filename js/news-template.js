//Копируем текущую ссылку в буфер обмена
function copyPageUrl() {
    var url = window.location.href;
    // Проверить поддержку метода navigator.clipboard.writeText()
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(function () {
            console.log('Скопировано в буфер обмена: ' + url);
        }, function () {
            console.error('Не удалось скопировать ссылку в буфер обмена');
            fallbackCopyTextToClipboard(url);
        });
    } else {
        fallbackCopyTextToClipboard(url);
    }
}

function fallbackCopyTextToClipboard(text) {
    var input = document.createElement('input');
    input.setAttribute('value', text);
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
    console.log('Скопировано в буфер обмена: ' + text);
}