const filters = document.querySelector(".filters");
function openFilters() {
    filters.classList.toggle("actived")
}

function handleFeedbackAction(event) {
    const buttonClicked = event.currentTarget;
    const buttons = buttonClicked?.parentNode?.children ?? [];
    const feedbackAction = buttonClicked?.parentNode?.parentNode.querySelector('.feedback_action') ?? null;
    const allowedActions = ['like', 'dislike'];

    if ([buttonClicked, allowedActions.includes(buttonClicked.dataset.action), feedbackAction, buttons].some(verify => !!!verify)) return;

    const action = buttonClicked.dataset.action;

    Array.from(buttons).forEach(btn => {
        btn.style.opacity = "0.4";
    });

    buttonClicked.style.opacity = "1";
    feedbackAction.value = action;
}

const cpfInput = document.querySelector('#cpf');

cpfInput.addEventListener('input', () => {
    let cpfArr = [];
    let mask = '';
    if (cpfInput.value.replaceAll(/[\.-]/g, '').length == 11) {
        cpfArr = cpfInput.value.split('');

        cpfArr.forEach((v) => {
            if (mask.length == 3 || mask.length == 7) {
                mask += '.'
            }

            if (mask.length == 11) {
                mask += '-'
            }
            mask += v
            cpfInput.value = mask;

        });
    }

    if (cpfInput.value.length > 14) {
        cpfInput.value = cpfInput.value.slice(0, 14);
    }
})