<?php
namespace PhoneBook;

class Core
{
    /**
     * @var IStorage
     */
    private $storage;

    public function __construct(IStorage $storage)
    {
        $this->contacts = $storage->readContacts();
    }

    public function proceedFormData()
    {
        $contacts = [];
        $i = 0;
        while (isset($_REQUEST["contact_name_" . $i]) || isset($_REQUEST["contact_phone_" . $i])) {
            $name = $_REQUEST["contact_name_" . $i];
            $phone = $_REQUEST["contact_phone_" . $i];
            if (!empty($name) || !empty($phone)) {
                $contacts[] = $this->storage->getNewContactInstance($name, $phone);
            }
            $i++;
        }
        $this->storage->storeContacts($contacts);
    }

    public function display(IView $view)
    {
        $view->display($this->storage->readContacts());
    }
}
