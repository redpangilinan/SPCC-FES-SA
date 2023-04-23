const copyToClipboard = (textId) => {
    const copyText = document.querySelector(textId);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
}

