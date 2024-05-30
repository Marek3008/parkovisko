async function mqttData(url) {
    const response = await fetch(url);
    const result = await response.json();
    return result;
}

const mqtt_url = "ws://10.42.0.1:8080/mqtt";
const client = mqtt.connect(mqtt_url);

client.on("connect", function () {
    console.log("Connected to mqtt broker");
    // Subscribe to a topic
    if (typeof topicsArray !== "undefined" && Array.isArray(topicsArray)) {
        topicsArray.forEach((topic) => {
            client.subscribe(topic);
        });
    } else {
        console.log("No topics to subscribe");
    }
});
