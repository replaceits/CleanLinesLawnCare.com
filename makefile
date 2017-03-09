BUILD           = ./build/
BUILD_PATH      = $(BUILD)CleanLinesLawnCare.com/
BUILD_TMP_PATH  = $(BUILD)tmp/

SCSS_PATH       = ./stylesheets/
SCSS_MAIN       = $(SCSS_PATH)CleanLinesLawnCare.com.scss
SCSS_FILES      = $(shell find $(SCSS_PATH) -type f -name '*.scss')

CSS_TARGET_PATH = $(BUILD_PATH)css/
CSS_TARGET      = $(CSS_TARGET_PATH)CleanLinesLawnCare.com.css

ESCAPE_SED = sed -e 's/[]\/$*.^|[]/\\&/g'

JS_PATH         = ./javascripts/
JS_FILES        = $(shell find $(JS_PATH) -type f -name '*.js')
JS_TARGET_PATH  = $(BUILD_PATH)js/
JS_TMP_TARGET  = $(shell echo $(JS_PATH) | $(ESCAPE_SED))
JS_TMP_TARGET_PATH = $(shell echo $(JS_TARGET_PATH) | $(ESCAPE_SED))
JS_TARGETS      = $(shell echo $(JS_FILES) | sed 's/$(JS_TMP_TARGET)/$(JS_TMP_TARGET_PATH)/g')


ERRORS_PATH        = ./errors/
ERRORS_FILES       = $(shell find $(ERRORS_PATH) -type f -name '*.php')
ERRORS_TARGET_PATH = $(BUILD_PATH)errors/
ERRORS_TMP_TARGET  = $(shell echo $(ERRORS_PATH) | $(ESCAPE_SED))
ERRORS_TMP_TARGET_PATH = $(shell echo $(ERRORS_TARGET_PATH) | $(ESCAPE_SED))
ERRORS_TARGETS     = $(shell echo $(ERRORS_FILES) | sed 's/$(ERRORS_TMP_TARGET)/$(ERRORS_TMP_TARGET_PATH)/g')

ABOUT_PATH        = ./about/
ABOUT_FILES       = $(shell find $(ABOUT_PATH) -type f -name '*.*')
ABOUT_TARGET_PATH = $(BUILD_PATH)about/
ABOUT_TMP_TARGET  = $(shell echo $(ABOUT_PATH) | $(ESCAPE_SED))
ABOUT_TMP_TARGET_PATH = $(shell echo $(ABOUT_TARGET_PATH) | $(ESCAPE_SED))
ABOUT_TARGETS     = $(shell echo $(ABOUT_FILES) | sed 's/$(ABOUT_TMP_TARGET)/$(ABOUT_TMP_TARGET_PATH)/g')

CONTACT_PATH        = ./contact/
CONTACT_FILES       = $(shell find $(CONTACT_PATH) -type f -name '*.*')
CONTACT_TARGET_PATH = $(BUILD_PATH)contact/
CONTACT_TMP_TARGET  = $(shell echo $(CONTACT_PATH) | $(ESCAPE_SED))
CONTACT_TMP_TARGET_PATH = $(shell echo $(CONTACT_TARGET_PATH) | $(ESCAPE_SED))
CONTACT_TARGETS     = $(shell echo $(CONTACT_FILES) | sed 's/$(CONTACT_TMP_TARGET)/$(CONTACT_TMP_TARGET_PATH)/g')

ESTIMATE_PATH        = ./estimate/
ESTIMATE_FILES       = $(shell find $(ESTIMATE_PATH) -type f -name '*.*')
ESTIMATE_TARGET_PATH = $(BUILD_PATH)estimate/
ESTIMATE_TMP_TARGET  = $(shell echo $(ESTIMATE_PATH) | $(ESCAPE_SED))
ESTIMATE_TMP_TARGET_PATH = $(shell echo $(ESTIMATE_TARGET_PATH) | $(ESCAPE_SED))
ESTIMATE_TARGETS     = $(shell echo $(ESTIMATE_FILES) | sed 's/$(ESTIMATE_TMP_TARGET)/$(ESTIMATE_TMP_TARGET_PATH)/g')

SERVICES_PATH        = ./services/
SERVICES_FILES       = $(shell find $(SERVICES_PATH) -type f -name '*.*')
SERVICES_TARGET_PATH = $(BUILD_PATH)services/
SERVICES_TMP_TARGET  = $(shell echo $(SERVICES_PATH) | $(ESCAPE_SED))
SERVICES_TMP_TARGET_PATH = $(shell echo $(SERVICES_TARGET_PATH) | $(ESCAPE_SED))
SERVICES_TARGETS     = $(shell echo $(SERVICES_FILES) | sed 's/$(SERVICES_TMP_TARGET)/$(SERVICES_TMP_TARGET_PATH)/g')

IMAGES_PATH        = ./images/
IMAGES_FILES       = $(shell find $(IMAGES_PATH) -type f -name '*.*')
IMAGES_TARGET_PATH = $(BUILD_PATH)images/
IMAGES_TMP_TARGET  = $(shell echo $(IMAGES_PATH) | $(ESCAPE_SED))
IMAGES_TMP_TARGET_PATH = $(shell echo $(IMAGES_TARGET_PATH) | $(ESCAPE_SED))
IMAGES_TARGETS     = $(shell echo $(IMAGES_FILES) | sed 's/$(IMAGES_TMP_TARGET)/$(IMAGES_TMP_TARGET_PATH)/g')

HTML_FILE = index.html
MISC_FILES = humans.txt robots.txt sitemap.xml

BUILD_PATH_ESCAPED = $(shell echo $(BUILD_PATH) | $(ESCAPE_SED))
HTML_FILE_TARGET = $(shell echo $(HTML_FILE) | sed 's/^/$(BUILD_PATH_ESCAPED)/g')
MISC_FILES_TARGET = $(shell echo $(MISC_FILES) | sed 's/ /\n/g' | sed 's/^/$(BUILD_PATH_ESCAPED)/g')

DIRECTORIES     = $(BUILD_PATH) $(JS_TARGET_PATH) $(CSS_TARGET_PATH) $(ERRORS_TARGET_PATH) $(ABOUT_TARGET_PATH) $(CONTACT_TARGET_PATH) $(ESTIMATE_TARGET_PATH) $(SERViCES_TARGET_PATH) $(IMAGES_TARGET_PATH) $(FILES_TARGET_PATH)

all: | $(DIRECTORIES) css js errors about contact estimate services html misc images

css: $(SCSS_FILES) | $(DIRECTORIES) $(CSS_TARGET) 

js: $(JS_FILES) | $(DIRECTORIES) $(JS_TARGETS)

errors: $(ERRORS_FILES) | $(DIRECTORIES) $(ERRORS_TARGETS)

about: $(ABOUT_FILES) | $(DIRECTORIES) $(ABOUT_TARGETS)

contact: $(CONTACT_FILES) | $(DIRECTORIES) $(CONTACT_TARGETS)

estimate: $(ESTIMATE_FILES) | $(DIRECTORIES) $(ESTIMATE_TARGETS)

services: $(SERVICES_FILES) | $(DIRECTORIES) $(SERVICES_TARGETS)

html: $(HTML_FILE) | $(DIRECTORIES) $(HTML_FILE_TARGET)

misc: $(MISC_FILES) | $(DIRECTORIES) $(MISC_FILES_TARGET)

images: $(IMAGES_FILES) | $(DIRECTORIES) $(IMAGES_TARGETS)

$(IMAGES_TARGETS): $(IMAGES_FILES)
	@echo -e "Copying Images files...\t\t\t\c"
	@cp $(IMAGES_FILES) $(IMAGES_TARGET_PATH)
	@echo -e "[ Done ]"

$(HTML_FILE_TARGET): $(HTML_FILE)
	@echo -e "Copying HTML files...\t\t\t\c"
	@cp $(HTML_FILE) $(BUILD_PATH)
	@echo "[ Done ]"

$(MISC_FILES_TARGET): $(MISC_FILES)
	@echo -e "Copying Misc files...\t\t\t\c"
	@cp $(MISC_FILES) $(BUILD_PATH)
	@echo "[ Done ]"

$(ERRORS_TARGETS): $(ERRORS_FILES)
	@echo -e "Copying Error files...\t\t\t\c"
	@cp $(ERRORS_FILES) $(ERRORS_TARGET_PATH)
	@echo -e "[ Done ]"

$(ABOUT_TARGETS): $(ABOUT_FILES)
	@echo -e "Copying About files...\t\t\t\c"
	@cp $(ABOUT_FILES) $(ABOUT_TARGET_PATH)
	@echo -e "[ Done ]"

$(CONTACT_TARGETS): $(CONTACT_FILES)
	@echo -e "Copying Contact files...\t\t\c"
	@cp $(CONTACT_FILES) $(CONTACT_TARGET_PATH)
	@echo -e "[ Done ]"

$(ESTIMATE_TARGETS): $(ESTIMATE_FILES)
	@echo -e "Copying Estimate files...\t\t\c"
	@cp $(ESTIMATE_FILES) $(ESTIMATE_TARGET_PATH)
	@echo -e "[ Done ]"

$(SERVICES_TARGETS): $(SERVICES_FILES)
	@echo -e "Copying Services files...\t\t\c"
	@cp $(SERVICES_FILES) $(SERVICES_TARGET_PATH)
	@echo -e "[ Done ]"

$(CSS_TARGET): $(SCSS_FILES)
	@echo -e "Compiling SCSS...\t\t\t\c"
	@scss -C --sourcemap=none $(SCSS_MAIN) $(CSS_TARGET) -t compressed 
	@echo -e "[ Done ]"

$(JS_TARGETS): $(JS_FILES)
	@echo -e "Compressing JS...\t\t\t\c"
	@for JS in $(JS_FILES); do \
		yuicompressor --type js --charset utf-8 --nomunge -o $$(echo -n $(JS_TARGET_PATH)$$JS | sed 's/\.\/javascripts\///g') $$JS > /dev/null 2>&1; \
	done
	
	@echo "[ Done ]"

$(DIRECTORIES):
	@echo -e "Making directories...\t\t\t\c"
	@mkdir -p $(BUILD)
	@mkdir -p $(BUILD_PATH)
	@mkdir -p $(CSS_TARGET_PATH)
	@mkdir -p $(ERRORS_TARGET_PATH)
	@mkdir -p $(ABOUT_TARGET_PATH)
	@mkdir -p $(CONTACT_TARGET_PATH)
	@mkdir -p $(ESTIMATE_TARGET_PATH)
	@mkdir -p $(SERVICES_TARGET_PATH)
	@mkdir -p $(IMAGES_TARGET_PATH)
	@mkdir -p $(JS_TARGET_PATH)
	@mkdir -p $(JS_TARGET_PATH)/bootstrap/
	@echo "[ Done ]"

clean:
	@rm -rf $(CSS_TARGET_PATH) $(JS_TARGET_PATH) $(BUILD_PATH) $(BUILD)
