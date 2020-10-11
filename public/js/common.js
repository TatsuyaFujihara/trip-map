async function favorite(trip_id) {
    const res = await (await fetch("/trip/like", {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        body: JSON.stringify({
            trip_id: trip_id
        })
    })).json();
    const button = document.getElementById('favorite' + trip_id)
    console.log(button)
    if (res.is_liked) {
        console.log('お気に入りされました')
        button.className = 'btn btn-danger'
    } else {
        console.log('お気に入りが外されました')
        button.className = 'btn btn-outline-danger'
    }
}

