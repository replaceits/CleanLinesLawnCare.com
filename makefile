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

REVIEWS_PATH        = ./reviews/
REVIEWS_FILES       = $(shell find $(REVIEWS_PATH) -type f -name '*.*')
REVIEWS_TARGET_PATH = $(BUILD_PATH)reviews/
REVIEWS_TMP_TARGET  = $(shell echo $(REVIEWS_PATH) | $(ESCAPE_SED))
REVIEWS_TMP_TARGET_PATH = $(shell echo $(REVIEWS_TARGET_PATH) | $(ESCAPE_SED))
REVIEWS_TARGETS     = $(shell echo $(REVIEWS_FILES) | sed 's/$(REVIEWS_TMP_TARGET)/$(REVIEWS_TMP_TARGET_PATH)/g')

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

GALLERY_PATH        = ./gallery/
GALLERY_FILES       = $(shell find $(GALLERY_PATH) -type f -name '*.*')
GALLERY_TARGET_PATH = $(BUILD_PATH)gallery/
GALLERY_TMP_TARGET  = $(shell echo $(GALLERY_PATH) | $(ESCAPE_SED))
GALLERY_TMP_TARGET_PATH = $(shell echo $(GALLERY_TARGET_PATH) | $(ESCAPE_SED))
GALLERY_TARGETS     = $(shell echo $(GALLERY_FILES) | sed 's/$(GALLERY_TMP_TARGET)/$(GALLERY_TMP_TARGET_PATH)/g')

LOGIN_PATH        = ./login/
LOGIN_FILES       = $(shell find $(LOGIN_PATH) -type f -name '*.*')
LOGIN_TARGET_PATH = $(BUILD_PATH)login/
LOGIN_TMP_TARGET  = $(shell echo $(LOGIN_PATH) | $(ESCAPE_SED))
LOGIN_TMP_TARGET_PATH = $(shell echo $(LOGIN_TARGET_PATH) | $(ESCAPE_SED))
LOGIN_TARGETS     = $(shell echo $(LOGIN_FILES) | sed 's/$(LOGIN_TMP_TARGET)/$(LOGIN_TMP_TARGET_PATH)/g')

LOGOUT_PATH        = ./logout/
LOGOUT_FILES       = $(shell find $(LOGOUT_PATH) -type f -name '*.*')
LOGOUT_TARGET_PATH = $(BUILD_PATH)logout/
LOGOUT_TMP_TARGET  = $(shell echo $(LOGOUT_PATH) | $(ESCAPE_SED))
LOGOUT_TMP_TARGET_PATH = $(shell echo $(LOGOUT_TARGET_PATH) | $(ESCAPE_SED))
LOGOUT_TARGETS     = $(shell echo $(LOGOUT_FILES) | sed 's/$(LOGOUT_TMP_TARGET)/$(LOGOUT_TMP_TARGET_PATH)/g')

ADMIN_PATH        = ./admin/
ADMIN_FILES       = $(shell find $(ADMIN_PATH) -type f -name '*.*')
ADMIN_TARGET_PATH = $(BUILD_PATH)admin/
ADMIN_TMP_TARGET  = $(shell echo $(ADMIN_PATH) | $(ESCAPE_SED))
ADMIN_TMP_TARGET_PATH = $(shell echo $(ADMIN_TARGET_PATH) | $(ESCAPE_SED))
ADMIN_TARGETS     = $(shell echo $(ADMIN_FILES) | sed 's/$(ADMIN_TMP_TARGET)/$(ADMIN_TMP_TARGET_PATH)/g')

IMAGES_PATH        = ./images/
IMAGES_FILES       = $(shell find $(IMAGES_PATH) -type f -name '*.*')
IMAGES_TARGET_PATH = $(BUILD_PATH)images/
IMAGES_TMP_TARGET  = $(shell echo $(IMAGES_PATH) | $(ESCAPE_SED))
IMAGES_TMP_TARGET_PATH = $(shell echo $(IMAGES_TARGET_PATH) | $(ESCAPE_SED))
IMAGES_TARGETS     = $(shell echo $(IMAGES_FILES) | sed 's/$(IMAGES_TMP_TARGET)/$(IMAGES_TMP_TARGET_PATH)/g')

FONTS_PATH        = ./fonts/bootstrap/
FONTS_FILES       = $(shell find $(FONTS_PATH) -type f -name '*.*')
FONTS_TARGET_PATH = $(BUILD_PATH)fonts/bootstrap/
FONTS_TMP_TARGET  = $(shell echo $(FONTS_PATH) | $(ESCAPE_SED))
FONTS_TMP_TARGET_PATH = $(shell echo $(FONTS_TARGET_PATH) | $(ESCAPE_SED))
FONTS_TARGETS     = $(shell echo $(FONTS_FILES) | sed 's/$(FONTS_TMP_TARGET)/$(FONTS_TMP_TARGET_PATH)/g')

HTML_FILE = index.html
MISC_FILES = humans.txt robots.txt sitemap.xml message.php estimate.php android-chrome-192x192.png android-chrome-512x512.png apple-touch-icon.png browserconfig.xml favicon-16x16.png favicon-32x32.png favicon.ico manifest.json mstile-70x70.png mstile-150x150.png safari-pinned-tab.svg review.php galleryupload.php

BUILD_PATH_ESCAPED = $(shell echo $(BUILD_PATH) | $(ESCAPE_SED))
HTML_FILE_TARGET = $(shell echo $(HTML_FILE) | sed 's/^/$(BUILD_PATH_ESCAPED)/g')
MISC_FILES_TARGET = $(shell echo $(MISC_FILES) | sed 's/ /\n/g' | sed 's/^/$(BUILD_PATH_ESCAPED)/g')

DIRECTORIES     = $(BUILD_PATH) $(JS_TARGET_PATH) $(CSS_TARGET_PATH) $(ERRORS_TARGET_PATH) $(REVIEWS_TARGET_PATH) $(CONTACT_TARGET_PATH) $(ESTIMATE_TARGET_PATH) $(SERVICES_TARGET_PATH) $(GALLERY_TARGET_PATH) $(LOGIN_TARGET_PATH) $(LOGOUT_TARGET_PATH) $(ADMIN_TARGET_PATH) $(IMAGES_TARGET_PATH) $(FONTS_TARGET_PATH)

all: | $(DIRECTORIES) css js errors reviews contact estimate services gallery login logout admin html misc images fonts

css: $(SCSS_FILES) | $(DIRECTORIES) $(CSS_TARGET) 

js: $(JS_FILES) | $(DIRECTORIES) $(JS_TARGETS)

errors: $(ERRORS_FILES) | $(DIRECTORIES) $(ERRORS_TARGETS)

reviews: $(REVIEWS_FILES) | $(DIRECTORIES) $(REVIEWS_TARGETS)

contact: $(CONTACT_FILES) | $(DIRECTORIES) $(CONTACT_TARGETS)

estimate: $(ESTIMATE_FILES) | $(DIRECTORIES) $(ESTIMATE_TARGETS)

services: $(SERVICES_FILES) | $(DIRECTORIES) $(SERVICES_TARGETS)

gallery: $(GALLERY_FILES) | $(DIRECTORIES) $(GALLERY_TARGETS)

login: $(LOGIN_FILES) | $(DIRECTORIES) $(LOGIN_TARGETS)

logout: $(LOGOUT_FILES) | $(DIRECTORIES) $(LOGOUT_TARGETS)

admin: $(ADMIN_FILES) | $(DIRECTORIES) $(ADMIN_TARGETS)

html: $(HTML_FILE) | $(DIRECTORIES) $(HTML_FILE_TARGET)

misc: $(MISC_FILES) | $(DIRECTORIES) $(MISC_FILES_TARGET)

images: $(IMAGES_FILES) | $(DIRECTORIES) $(IMAGES_TARGETS)

fonts: $(FONTS_FILES) | $(DIRECTORIES) $(FONTS_TARGETS)

$(IMAGES_TARGETS): $(IMAGES_FILES)
	@echo -e "Copying Images...\t\t\t\c"
	@cp $(IMAGES_FILES) $(IMAGES_TARGET_PATH)
	@echo -e "[ Done ]"

$(FONTS_TARGETS): $(FONTS_FILES)
	@echo -e "Copying Fonts...\t\t\t\c"
	@cp $(FONTS_FILES) $(FONTS_TARGET_PATH)
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

$(REVIEWS_TARGETS): $(REVIEWS_FILES)
	@echo -e "Copying Reviews files...\t\t\c"
	@cp $(REVIEWS_FILES) $(REVIEWS_TARGET_PATH)
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

$(GALLERY_TARGETS): $(GALLERY_FILES)
	@echo -e "Copying Gallery files...\t\t\c"
	@cp $(GALLERY_FILES) $(GALLERY_TARGET_PATH)
	@echo -e "[ Done ]"

$(LOGIN_TARGETS): $(LOGIN_FILES)
	@echo -e "Copying Login files...\t\t\t\c"
	@cp $(LOGIN_FILES) $(LOGIN_TARGET_PATH)
	@echo -e "[ Done ]"

$(LOGOUT_TARGETS): $(LOGOUT_FILES)
	@echo -e "Copying Logout files...\t\t\t\c"
	@cp $(LOGOUT_FILES) $(LOGOUT_TARGET_PATH)
	@echo -e "[ Done ]"

$(ADMIN_TARGETS): $(ADMIN_FILES)
	@echo -e "Copying Admin files...\t\t\t\c"
	@cp $(ADMIN_FILES) $(ADMIN_TARGET_PATH)
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
	@mkdir -p $(REVIEWS_TARGET_PATH)
	@mkdir -p $(CONTACT_TARGET_PATH)
	@mkdir -p $(ESTIMATE_TARGET_PATH)
	@mkdir -p $(SERVICES_TARGET_PATH)
	@mkdir -p $(GALLERY_TARGET_PATH)
	@mkdir -p $(LOGIN_TARGET_PATH)
	@mkdir -p $(LOGOUT_TARGET_PATH)
	@mkdir -p $(ADMIN_TARGET_PATH)
	@mkdir -p $(IMAGES_TARGET_PATH)
	@mkdir -p $(FONTS_TARGET_PATH)
	@mkdir -p $(JS_TARGET_PATH)
	@mkdir -p $(JS_TARGET_PATH)/bootstrap/
	@echo "[ Done ]"

clean:
	@rm -rf $(CSS_TARGET_PATH) $(JS_TARGET_PATH) $(BUILD_PATH) $(BUILD)
