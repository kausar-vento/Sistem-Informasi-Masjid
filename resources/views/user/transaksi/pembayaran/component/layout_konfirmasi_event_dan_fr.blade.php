<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="item-{{$key}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse{{$key}}" aria-expanded="false"
                aria-controls="flush-collapse{{$key}}">
                <strong>{{$ticket['name']}}</strong>
            </button>
        </h2>
        <div id="flush-collapse{{$key}}" class="accordion-collapse collapse"
            aria-labelledby="item-{{$key}}" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <ul>
                    <li>Harga Tiket: <strong>@harga($ticket['price'])</strong></li>
                    <li>Jumlah Tiket: <strong>{{$ticket['quantity']}}</strong></li>
                    <li>Total: <strong>@harga($ticket['price'] * $ticket['quantity'])</strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>