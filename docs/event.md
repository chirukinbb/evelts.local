Get list

v1/events get-method

````json
{
    "data": [
        {
            "id": 3,
            "title": "tttttttttttttt",
            "thumbnail_url": "events/thumbnails/CEmolmvG4JxVb7Kd39AKu1ToeUc1OMSV7B4TB5Yu.png",
            "country": "Country object *",
            "point": "Point object **",
            "category": "Category object ***",
            "author": "User object ****",
            "tags": [
                "Tag object *****"
            ]
        }
    ]
}
````

* [Country Object](https://github.com/chirukinbb/evelts.local/blob/master/docs/objects/country.md)

**    [Point Object](https://github.com/chirukinbb/evelts.local/blob/master/docs/objects/point.md)

***   [Category Object](https://github.com/chirukinbb/evelts.local/blob/master/docs/objects/category.md)

****  [User Object](https://github.com/chirukinbb/evelts.local/blob/master/docs/objects/user.md)

***** [Tag Object](https://github.com/chirukinbb/evelts.local/blob/master/docs/objects/tag.md)

Get single

v1/event/:id

Response

````json
{
    "id": 4,
    "title": "kkkkkkkkkkkkk002227",
    "thumbnail_url": "events/thumbnails/2BAGs02kjvsGb7k6Wlxhl3S1cmjEguopUenhjfL7.png",
    "description": "ggggggggggggggghg",
    "coordinate_lat": "50.59649",
    "coordinate_lng": "32.34367",
    "category": "Category object ***",
    "author": "User object ****",
    "slots": 99,
    "tags": [
        "Tag object *****"
    ]
    "gallery": [
        "Photo object ******"
    ],
    "comments": [
        "Comment object"
    ],
    "planing_time": "1672480800000"
}
````

Add event
