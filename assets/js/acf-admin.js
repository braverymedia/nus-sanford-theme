acf.add_filter('color_picker_args', function( args, field ){

    // do something to args
    args.palettes = ['#F3F3F4', '#1c68ba', '#8dc806', '#b0412b' ]


    // return
    return args;

});
