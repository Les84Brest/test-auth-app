document.addEventListener('DOMContentLoaded', function () {
    const registrationFormNode = document.forms.registration_form;
    const loginFormNode = document.forms.login_form;

    if (registrationFormNode) {
        new Form(registrationFormNode, 'siteregistration');
    }
    if (loginFormNode) {
        new Form(loginFormNode, 'sitelogin');
    }

    //sign out

    const signOutBtn = document.querySelector('[data-button-type="signOut"]');
    if (signOutBtn) {
        signOutBtn.addEventListener("click", async function (e) {
            const queryUrl = new URL('sitelogout', window.origin);
            const payload = { logOut: true };
            const response = await fetch(queryUrl.href, {
                method: 'POST',
                body: JSON.stringify(payload),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            if (response.ok) {
                const { status  } = await response.json();

                if (status) {
                    location.reload();
                }
            }
        });
    }
})


class Form {
    formNode = null;
    actionController = null;

    constructor(formNode, actionController) {
        this.formNode = formNode;
        this.actionController = actionController;

        this.formNode.addEventListener('submit', (e) => {
            this.handleFormSubmit(e);
        })

    }

    async handleFormSubmit(e) {
        e.preventDefault();
        const formData = new FormData(this.formNode);

        let response = await this.sendFormData(formData);
        const { isLogined } = response;

        if (isLogined) {
            window.location = '/';
        } else {
            window.location.reload();
        }

        // if (response.status == 'error') {
        //     this.handleServerError(response);
        // }

    }

    handleServerError(response) {
        // const { fields } = response;
        // const messageText = Object.entries(fields).reduce((acc, cur) => {
        //     const [key, val] = cur;
        //     return acc += `${key} - ${val} <br/>`;
        // }, '')

        // this.snackbar.open(TYPE_ERROR, messageText);
        // this.formNode.reset();
        // this.formNode.formSubmit.disabled = true;
        console.log('%cserver error', 'padding: 5px; background: hotpink; color: black;');
    }
    async sendFormData(formData) {

        const urlEncoded = new URLSearchParams(formData).toString();
        const queryUrl = new URL(this.actionController, window.origin);

        const response = await fetch(queryUrl.href, {
            method: 'POST',
            body: urlEncoded,
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }
        });
        if (response.ok) {
            let result = await response.json();
            return result;
        } else {
            let errorRes = await response.json();
            return errorRes;
        }
    }
}
