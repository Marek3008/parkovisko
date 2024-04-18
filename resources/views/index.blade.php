<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scheidt&bachmann</title>
    <script src=""></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        async function mqttData(url){
            const response = await fetch(url);
            const models = await response.json();
            return models;
        }

        const mqtt_url = 'ws://broker.emqx.io:8083/mqtt';
        const client = mqtt.connect(mqtt_url);
        client.on('connect', function () {
            console.log('Connected');
            // Subscribe to a topic
            client.subscribe('banasko/zmena');
        })

        //update ked pride sprava na topic
        client.on('message', function (topic, message) {
            let html = ``;
            mqttData("{{ route('banasko') }}").then(models => {
                models.forEach((element, index) => {
                    console.log(element);
                    content = `<p>${element.occupied}</p>`;
                    document.getElementById(`${element.sensor.special_id}`).innerHTML = content;
                });
            });
        })
    </script>
</head>
<body>
    <div class="parkovisko" style="display: flex; justify-content: space-around;">
        @foreach ($slots as $slot)
            <div id="{{$slot->sensor->special_id}}">
                <p>{{$slot->occupied}}</p>
            </div>
        @endforeach
    </div>
</body>
</html>