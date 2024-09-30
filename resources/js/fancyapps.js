import { Fancybox } from "@fancyapps/ui";

Fancybox.bind('[data-fancybox="single"]', {
    Toolbar: {
        display: {
            left: ["infobar"],
            middle: [
                "zoomIn",
                "zoomOut",
                "toggle1to1",
                "rotateCCW",
                "rotateCW",
                "flipX",
                "flipY",
            ],
            right: ["close"],
        },
    },
});