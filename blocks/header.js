wp.blocks.registerBlockType("johncartercustom/header", {
    title: "Custom Header",
    edit: function () {
        return wp.element.createElement("div", { className: `johncarter-block-placeholder` }, "Header placeholder")
    },
    save: function () {
        return null
    }
})
