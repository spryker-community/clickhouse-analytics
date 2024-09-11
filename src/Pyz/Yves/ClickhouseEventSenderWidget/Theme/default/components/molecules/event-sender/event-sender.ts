import Component from 'ShopUi/models/component';

export default class EventSender extends Component {
    protected readyCallback(): void {
    }

    protected init(): void {
        this.sendViewEvent();

        this.addEventListeners();
    }

    private addEventListeners() {
        const triggers = <HTMLElement[]>Array.from(document.querySelectorAll('[data-qa="add-to-cart-button"]'));

        for (const trigger of triggers) {
            trigger.addEventListener('click', () => this.sendAddToCartEvent(trigger.getAttribute('content')));
        }
    }

    private sendViewEvent() {
        const body = {
            user_id: this.userSessionId,
            name: 'page_view',
            value: null,
        };

        this.sendRequest(body);
    }

    private sendAddToCartEvent(content: string) {
        const body = {
            user_id: this.userSessionId,
            name: 'add_to_cart',
            value: null,
            content,
        };

        this.sendRequest(body);
    }

    get userSessionId(): string {
        return this.getAttribute('user-session-id');
    }

    private sendRequest(body: object) {
        console.log(body);
        fetch('http://analytics.spryker.local:8888/event', {
            method: 'POST',
            body: JSON.stringify(body),
            headers: {
                'Content-Type': 'application/json',
            },
            referrerPolicy: 'unsafe-url',
        }).catch((error) => {
            console.error('Error:', error);
        });
    }

    get value(): string {
        return this.getAttribute('value');
    }
}
