try {
    var $ = jQuery;
} catch {
    console.log('No JQuery enabled, go to Admin page -> Theme Settings -> Performance Settings and enable it.');
    $ = null;
}

export default $;