# Simple Recommendation System


## What is it
This is a simple program where you upload a playlist, then from the playlist the program selects and recommends songs based on the playlist search.


## How to run

```bash
npm install

npm run dev

# if you want to build
npm run build
```

## where to get playlists

playlist have the following json structure:
```json
[
    {
        "no": 1,
        "artist": "artist",
        "song": "song",
        "album_cover": "album_cover"
    }
]
```

> you can use this [golang program](https://gist.github.com/bethropolis/ce5c20b8b3a753625b1ac1fa0562d199) to get playlists from spotify automatically.



## License
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).

