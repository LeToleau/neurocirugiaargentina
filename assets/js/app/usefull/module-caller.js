const moduleCaller = (modules) => {
    //JSON
    if (modules.length) {
        modules.forEach(module => {
            const modulesDom = document.querySelectorAll(module.domModule);
            //EACH of json
            modulesDom.forEach(singleModule => {
                const classInstance = new module.classModule(singleModule);
                classInstance.init();
            })
        });
    } else {
        const modulesDom = document.querySelectorAll(modules.domModule);
        //EACH of json
        modulesDom.forEach(singleModule => {
            const classInstance = new modules.classModule(singleModule);
            classInstance.init();
        })
    }
}

export default moduleCaller;