<?php

//----------------- Admin Breadcrumbs -----------------//

# OutPut:-  Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard.index'));
});

# OutPut:-  Dashboard > Settings
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Settings', route('admin.change.password'));
});

//------ Admin CRUD ------//
# OutPut:-  Dashboard > Admin List
Breadcrumbs::for('adminList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Admin List', route('admin.admin.index'));
});

# OutPut:-  Dashboard > Admin List > Admin Create
Breadcrumbs::for('adminCreate', function ($trail) {
    $trail->parent('adminList');
    $trail->push('Create', route('admin.admin.create'));
});

# OutPut:-  Dashboard > Admin List > Admin Update
Breadcrumbs::for('adminUpdate', function ($trail) {
    $trail->parent('adminList');
    $trail->push('Update');
});
//------ User CRUD ------//
# OutPut:-  Dashboard > User List
Breadcrumbs::for('userList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('User List', route('admin.user.index'));
});

# OutPut:-  Dashboard > User List > User Create
Breadcrumbs::for('userCreate', function ($trail) {
    $trail->parent('userList');
    $trail->push('Create', route('admin.user.create'));
});

# OutPut:-  Dashboard > User List > User Update
Breadcrumbs::for('userUpdate', function ($trail) {
    $trail->parent('userList');
    $trail->push('Update');
});

//------ Category CRUD ------//
# OutPut:-  Dashboard > Category List
Breadcrumbs::for('categoryList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Category List', route('admin.category.index'));
});

# OutPut:-  Dashboard > Category List > Category Create
Breadcrumbs::for('categoryCreate', function ($trail) {
    $trail->parent('categoryList');
    $trail->push('Create', route('admin.category.create'));
});

# OutPut:-  Dashboard > Category List > Category Update
Breadcrumbs::for('categoryUpdate', function ($trail) {
    $trail->parent('categoryList');
    $trail->push('Update');
});

//------ Metal CRUD ------//
# OutPut:-  Dashboard > Metal List
Breadcrumbs::for('metalList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Metal List', route('admin.metal.index'));
});

# OutPut:-  Dashboard > Metal List > Metal Create
Breadcrumbs::for('metalCreate', function ($trail) {
    $trail->parent('metalList');
    $trail->push('Create', route('admin.metal.create'));
});

# OutPut:-  Dashboard > Metal List > Metal Update
Breadcrumbs::for('metalUpdate', function ($trail) {
    $trail->parent('metalList');
    $trail->push('Update');
});


//------ Material CRUD ------//
# OutPut:-  Dashboard > Material List
Breadcrumbs::for('materialList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Material List', route('admin.material.index'));
});

# OutPut:-  Dashboard > Material List > Material Create
Breadcrumbs::for('materialCreate', function ($trail) {
    $trail->parent('materialList');
    $trail->push('Create', route('admin.material.create'));
});

# OutPut:-  Dashboard > Material List > Material Update
Breadcrumbs::for('materialUpdate', function ($trail) {
    $trail->parent('materialList');
    $trail->push('Update');
});


//------ Size CRUD ------//
# OutPut:-  Dashboard > Size List
Breadcrumbs::for('sizeList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Metal List', route('admin.size.index'));
});

# OutPut:-  Dashboard > Size List > Size Create
Breadcrumbs::for('sizeCreate', function ($trail) {
    $trail->parent('sizeList');
    $trail->push('Create', route('admin.size.create'));
});

# OutPut:-  Dashboard > Size List > Size Update
Breadcrumbs::for('sizeUpdate', function ($trail) {
    $trail->parent('sizeList');
    $trail->push('Update');
});

//------ Product CRUD ------//
# OutPut:-  Dashboard > Product List
Breadcrumbs::for('productList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Product List', route('admin.product.index'));
});

# OutPut:-  Dashboard > Product List > Product Create
Breadcrumbs::for('productCreate', function ($trail) {
    $trail->parent('productList');
    $trail->push('Create', route('admin.product.create'));
});

# OutPut:-  Dashboard > Product List > Product Update
Breadcrumbs::for('productUpdate', function ($trail) {
    $trail->parent('productList');
    $trail->push('Update');
});

//------ CMSPAGE CRUD ------//
# OutPut:-  Dashboard > CMS Page List
Breadcrumbs::for('cmspageList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('CMS Page List', route('admin.cmspage.index'));
});

# OutPut:-  Dashboard > CMS Page List > CMS Page Create
Breadcrumbs::for('cmspageCreate', function ($trail) {
    $trail->parent('cmspageList');
    $trail->push('Create', route('admin.cmspage.create'));
});

# OutPut:-  Dashboard > CMS Page List > CMS Page Update
Breadcrumbs::for('cmspageUpdate', function ($trail) {
    $trail->parent('cmspageList');
    $trail->push('Update');
});

//------ FAQ CRUD ------//
# OutPut:-  Dashboard > FAQ
Breadcrumbs::for('faqList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('FAQ List', route('admin.faq.index'));
});

# OutPut:-  Dashboard > FAQ List > FAQ Create
Breadcrumbs::for('faqCreate', function ($trail) {
    $trail->parent('faqList');
    $trail->push('Create', route('admin.faq.create'));
});

# OutPut:-  Dashboard > FAQ List > FAQ Update
Breadcrumbs::for('faqUpdate', function ($trail) {
    $trail->parent('faqList');
    $trail->push('Update');
});

//------ Home page Slider ------//
# OutPut:-  Dashboard > FAQ
Breadcrumbs::for('homepagesliderList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Home Page Slider', route('admin.homepageslider.index'));
});

//------ Home page ------//
# OutPut:-  Dashboard > FAQ
Breadcrumbs::for('homepageList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Home Page', route('admin.homepage.index'));
});

//------ Blog CRUD ------//
# OutPut:-  Dashboard > Blog
Breadcrumbs::for('blogList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Blog List', route('admin.blog.index'));
});

# OutPut:-  Dashboard > Blog List > Blog Create
Breadcrumbs::for('blogCreate', function ($trail) {
    $trail->parent('blogList');
    $trail->push('Create', route('admin.blog.create'));
});

# OutPut:-  Dashboard > Blog List > Blog Update
Breadcrumbs::for('blogUpdate', function ($trail) {
    $trail->parent('blogList');
    $trail->push('Update');
});

//------ Contact CRUD ------//
# OutPut:-  Dashboard > Contact List
Breadcrumbs::for('contactList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Contact List', route('admin.contact.index'));
});

# OutPut:-  Dashboard > Contact List > Contact Create
Breadcrumbs::for('contactCreate', function ($trail) {
    $trail->parent('contactList');
    $trail->push('Create', route('admin.contact.create'));
});

# OutPut:-  Dashboard > Contact List > Contact Update
Breadcrumbs::for('contactUpdate', function ($trail) {
    $trail->parent('contactList');
    $trail->push('Update');
});


//------ blogcategory CRUD ------//
# OutPut:-  Dashboard > blogcategory List
Breadcrumbs::for('blogcategoryList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Blog Category List', route('admin.blogcategory.index'));
});

# OutPut:-  Dashboard > blogcategory List > blogcategory Create
Breadcrumbs::for('blogcategoryCreate', function ($trail) {
    $trail->parent('blogcategoryList');
    $trail->push('Create', route('admin.blogcategory.create'));
});

# OutPut:-  Dashboard > blogcategory List > blogcategory Update
Breadcrumbs::for('blogcategoryUpdate', function ($trail) {
    $trail->parent('blogcategoryList');
    $trail->push('Update');
});


//------ Country ------//
# OutPut:-  Dashboard > FAQ
Breadcrumbs::for('countryList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Country', route('admin.country.index'));
});


//------ Coupon CRUD ------//
# OutPut:-  Dashboard > coupon List
Breadcrumbs::for('couponList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Coupon List', route('admin.coupon.index'));
});

# OutPut:-  Dashboard > coupon List > coupon Create
Breadcrumbs::for('couponCreate', function ($trail) {
    $trail->parent('couponList');
    $trail->push('Create', route('admin.coupon.create'));
});

# OutPut:-  Dashboard > coupon List > coupon Update
Breadcrumbs::for('couponUpdate', function ($trail) {
    $trail->parent('couponList');
    $trail->push('Update');
});



//------ Testimonial CRUD ------//
# OutPut:-  Dashboard > Testimonial List
Breadcrumbs::for('testimonialList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Testimonial List', route('admin.testimonial.index'));
});

# OutPut:-  Dashboard > Testimonial List > Testimonial Create
Breadcrumbs::for('testimonialCreate', function ($trail) {
    $trail->parent('testimonialList');
    $trail->push('Create', route('admin.testimonial.create'));
});

# OutPut:-  Dashboard > Testimonial List > Testimonial Update
Breadcrumbs::for('testimonialUpdate', function ($trail) {
    $trail->parent('testimonialList');
    $trail->push('Update');
});


//------ Order CRUD ------//
# OutPut:-  Dashboard > Testimonial List
Breadcrumbs::for('orderList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Order List', route('admin.order.index'));
});

# OutPut:-  Dashboard > order List > order Create
Breadcrumbs::for('orderCreate', function ($trail) {
    $trail->parent('orderList');
    $trail->push('Create', route('admin.order.create'));
});

# OutPut:-  Dashboard > order List > order Update
Breadcrumbs::for('orderUpdate', function ($trail) {
    $trail->parent('orderList');
    $trail->push('Update');
});


//------ Newsletter ------//
# OutPut:-  Dashboard > FAQ
Breadcrumbs::for('newsletterList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Newsletter', route('admin.newsletter.index'));
});


//------ Shape CRUD ------//
# OutPut:-  Dashboard > Testimonial List
Breadcrumbs::for('shapeList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Shape List', route('admin.shape.index'));
});

# OutPut:-  Dashboard > shape List > shape Create
Breadcrumbs::for('shapeCreate', function ($trail) {
    $trail->parent('shapeList');
    $trail->push('Create', route('admin.shape.create'));
});

# OutPut:-  Dashboard > shape List > shape Update
Breadcrumbs::for('shapeUpdate', function ($trail) {
    $trail->parent('shapeList');
    $trail->push('Update');
});


//------ color CRUD ------//
# OutPut:-  Dashboard > Testimonial List
Breadcrumbs::for('colorList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('color List', route('admin.color.index'));
});

# OutPut:-  Dashboard > color List > color Create
Breadcrumbs::for('colorCreate', function ($trail) {
    $trail->parent('colorList');
    $trail->push('Create', route('admin.color.create'));
});

# OutPut:-  Dashboard > color List > color Update
Breadcrumbs::for('colorUpdate', function ($trail) {
    $trail->parent('colorList');
    $trail->push('Update');
});


//------ clarity CRUD ------//
# OutPut:-  Dashboard > Testimonial List
Breadcrumbs::for('clarityList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Clarity List', route('admin.clarity.index'));
});

# OutPut:-  Dashboard > clarity List > clarity Create
Breadcrumbs::for('clarityCreate', function ($trail) {
    $trail->parent('clarityList');
    $trail->push('Create', route('admin.clarity.create'));
});

# OutPut:-  Dashboard > clarity List > clarity Update
Breadcrumbs::for('clarityUpdate', function ($trail) {
    $trail->parent('clarityList');
    $trail->push('Update');
});


//------ labour CRUD ------//
# OutPut:-  Dashboard > Labour List
Breadcrumbs::for('labourList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Labour List', route('admin.labour.index'));
});

# OutPut:-  Dashboard > labour List > labour Create
Breadcrumbs::for('labourCreate', function ($trail) {
    $trail->parent('labourList');
    $trail->push('Create', route('admin.labour.create'));
});

# OutPut:-  Dashboard > labour List > labour Update
Breadcrumbs::for('labourUpdate', function ($trail) {
    $trail->parent('labourList');
    $trail->push('Update');
});

//------ materialmetal CRUD ------//
# OutPut:-  Dashboard > materialmetal List
Breadcrumbs::for('materialmetalList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Material Metal List', route('admin.materialmetal.index'));
});

# OutPut:-  Dashboard > materialmetal List > materialmetal Create
Breadcrumbs::for('materialmetalCreate', function ($trail) {
    $trail->parent('materialmetalList');
    $trail->push('Create', route('admin.materialmetal.create'));
});

# OutPut:-  Dashboard > materialmetal List > labour Update
Breadcrumbs::for('materialmetalUpdate', function ($trail) {
    $trail->parent('materialmetalList');
    $trail->push('Update');
});

//------ packet CRUD ------//
# OutPut:-  Dashboard > packet List
Breadcrumbs::for('packetList', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Packet List', route('admin.packet.index'));
});

# OutPut:-  Dashboard > packet List > packet Create
Breadcrumbs::for('packetCreate', function ($trail) {
    $trail->parent('packetList');
    $trail->push('Create', route('admin.packet.create'));
});

# OutPut:-  Dashboard > packet List > packet Update
Breadcrumbs::for('packetUpdate', function ($trail) {
    $trail->parent('packetList');
    $trail->push('Update');
});


