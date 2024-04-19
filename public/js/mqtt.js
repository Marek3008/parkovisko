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
    const route = banaskoRoute; // global banaskoRoute = "{{ route('banasko') }}""
    mqttData(route).then(models => {
        models.forEach((element, index) => {
            console.log(element);
            let content = element.occupied == 1 ? "obsadené" : "voľné";
            let html = `<p>${content}</p>`;
            document.getElementById(`${element.sensor.special_id}`).innerHTML = html;
        });
    });
})