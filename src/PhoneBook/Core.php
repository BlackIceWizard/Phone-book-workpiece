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
        $this->storage = $storage;
    }

    public function proceedFormData()
    {
        $contacts = [];
        if (!isset($_REQUEST["contact"])) {
            return;
        }

        foreach ($_REQUEST["contact"] as $key => $contact_array) {
            if (!empty($contact_array['name']) || !empty($contact_array['phone'])) {
                $contacts[] = $this->storage->getNewContactInstance($contact_array['name'], $contact_array['phone']);
            }
        }
        $this->storage->storeContacts($contacts);
    }

    public function display(IView $view)
    {
        $view->display($this->storage->readContacts());
    }
}
