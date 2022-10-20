wp.blocks.registerBlockType("johncartercustom/footer", {
    title: "Custom Footer",
    edit: function () {
        return wp.element.createElement("div", { className: `johncarter-block-placeholder` }, "Footer placeholder")
    },
    save: function () {
        return null
    }
})
