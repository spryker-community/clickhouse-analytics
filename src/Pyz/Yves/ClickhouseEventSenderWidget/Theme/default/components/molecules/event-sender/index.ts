import register from 'ShopUi/app/registry';
export default register(
    'event-sender',
    () =>
        import(
            /* webpackMode: "lazy" */
            /* webpackChunkName: "event-sender" */
            './event-sender'
        ),
);
