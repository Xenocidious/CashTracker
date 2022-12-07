require('./bootstrap');

// Group Page
copyInviteCode = (invite_code) => {
    navigator.clipboard.writeText(invite_code)
    var tooltip = document.getElementById("myTooltip")
    tooltip.innerHTML = "Copied!"
    tooltip.style.width = "80px"
    tooltip.style.left = "58%"
}

outFunc = () => {
    var tooltip = document.getElementById("myTooltip")
    tooltip.innerHTML = "Copy to clipboard"
    tooltip.style.width = "150px"
    tooltip.style.left = "45%"
}

// Group Page Popup
paymentCreate = () => {
    var container = document.getElementById("popupContainer")
    var popup = document.getElementById("paymentForm")
    if (container.hidden === true) {
        container.hidden = false
        popup.hidden = false
    } else {
        container.hidden = true
        popup.hidden = true
    }
}