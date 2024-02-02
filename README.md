## Interview task
- Order is already created with selected payment method, now customer want to pay for it.
- Customer should call /order/pay/{orderId} endpoint with system or external order id. Body: { "idType": "external_id | system_id"}
- We need:
- Pick right payment service and call it to process payment
- Return correct response message to customer
- Return correct response status code

### Extra points
- Implemented docker to easy run the application
- Implemented unit tests