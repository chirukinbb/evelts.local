Get list

v1/events get-method

optional params

````json
{
    "search": "part of title or description",
    "categories": [
        "category id"
    ],
    "authors": [
        "author id"
    ],
    "points": [
        "point id"
    ],
    "countries": [
        "country id"
    ],
    "tags": [
        "tag id"
    ],
    "dates": [
        "unix-timestamp"
    ]
}
````

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
