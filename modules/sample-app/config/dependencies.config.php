<?php

namespace Amazium\Identity;

use Amazium\Kernel\Infrastructure\Db\Repository\DefaultEngineRepositoryFactory;
use Amazium\Kernel\UI\Page\PageFactory;
use Amazium\SampleApp\Application\Command\Address\AbandonAddressHandler;
use Amazium\SampleApp\Application\Command\Address\AbandonAddressHandlerImpl;
use Amazium\SampleApp\Application\Command\Address\ActivateAddressHandler;
use Amazium\SampleApp\Application\Command\Address\ActivateAddressHandlerImpl;
use Amazium\SampleApp\Application\Command\Address\AssignAddressToIdentityHandler;
use Amazium\SampleApp\Application\Command\Address\AssignAddressToIdentityHandlerImpl;
use Amazium\SampleApp\Application\Command\Address\CreateAddressHandler;
use Amazium\SampleApp\Application\Command\Address\CreateAddressHandlerImpl;
use Amazium\SampleApp\Application\Command\Address\DefaultAddressHandlerFactory;
use Amazium\SampleApp\Application\Command\Address\ModifyAddressDetailsHandler;
use Amazium\SampleApp\Application\Command\Address\ModifyAddressDetailsHandlerImpl;
use Amazium\SampleApp\Application\Command\BankAccount\AbandonBankAccountHandler;
use Amazium\SampleApp\Application\Command\BankAccount\AbandonBankAccountHandlerImpl;
use Amazium\SampleApp\Application\Command\BankAccount\ActivateBankAccountHandler;
use Amazium\SampleApp\Application\Command\BankAccount\ActivateBankAccountHandlerImpl;
use Amazium\SampleApp\Application\Command\BankAccount\DefaultBankAccountHandlerFactory;
use Amazium\SampleApp\Application\Command\BankAccount\ModifyBankAccountDetailsHandler;
use Amazium\SampleApp\Application\Command\BankAccount\ModifyBankAccountDetailsHandlerImpl;
use Amazium\SampleApp\Application\Command\BankAccount\RequestBankAccountHandler;
use Amazium\SampleApp\Application\Command\BankAccount\RequestBankAccountHandlerImpl;
use Amazium\SampleApp\Application\Command\Card\AbandonCardHandler;
use Amazium\SampleApp\Application\Command\Card\AbandonCardHandlerImpl;
use Amazium\SampleApp\Application\Command\Card\ActivateCardHandler;
use Amazium\SampleApp\Application\Command\Card\ActivateCardHandlerImpl;
use Amazium\SampleApp\Application\Command\Card\DefaultCardHandlerFactory;
use Amazium\SampleApp\Application\Command\Card\ModifyCardDetailsHandler;
use Amazium\SampleApp\Application\Command\Card\ModifyCardDetailsHandlerImpl;
use Amazium\SampleApp\Application\Command\Card\RequestCardHandler;
use Amazium\SampleApp\Application\Command\Card\RequestCardHandlerImpl;
use Amazium\SampleApp\Application\Command\Document\DefaultDocumentHandlerFactory;
use Amazium\SampleApp\Application\Command\Document\DeleteDocumentHandler;
use Amazium\SampleApp\Application\Command\Document\DeleteDocumentHandlerImpl;
use Amazium\SampleApp\Application\Command\Document\ModifyDocumentDetailsHandler;
use Amazium\SampleApp\Application\Command\Document\ModifyDocumentDetailsHandlerImpl;
use Amazium\SampleApp\Application\Command\Document\ReplaceDocumentHandler;
use Amazium\SampleApp\Application\Command\Document\ReplaceDocumentHandlerImpl;
use Amazium\SampleApp\Application\Command\Document\UploadDocumentHandler;
use Amazium\SampleApp\Application\Command\Document\UploadDocumentHandlerImpl;
use Amazium\SampleApp\Application\Command\Identity\AbandonIdentityHandler;
use Amazium\SampleApp\Application\Command\Identity\AbandonIdentityHandlerImpl;
use Amazium\SampleApp\Application\Command\Identity\ActivateIdentityHandler;
use Amazium\SampleApp\Application\Command\Identity\ActivateIdentityHandlerImpl;
use Amazium\SampleApp\Application\Command\Identity\CreateIdentityHandler;
use Amazium\SampleApp\Application\Command\Identity\CreateIdentityHandlerImpl;
use Amazium\SampleApp\Application\Command\Identity\DefaultIdentityHandlerFactory;
use Amazium\SampleApp\Application\Command\Identity\ModifyIdentityDetailsHandler;
use Amazium\SampleApp\Application\Command\Identity\ModifyIdentityDetailsHandlerImpl;
use Amazium\SampleApp\Application\Command\Phone\AbandonPhoneHandler;
use Amazium\SampleApp\Application\Command\Phone\AbandonPhoneHandlerImpl;
use Amazium\SampleApp\Application\Command\Phone\ActivatePhoneHandler;
use Amazium\SampleApp\Application\Command\Phone\ActivatePhoneHandlerImpl;
use Amazium\SampleApp\Application\Command\Phone\DefaultPhoneHandlerFactory;
use Amazium\SampleApp\Application\Command\Phone\ModifyPhoneDetailsHandler;
use Amazium\SampleApp\Application\Command\Phone\ModifyPhoneDetailsHandlerImpl;
use Amazium\SampleApp\Application\Command\Phone\RegisterPhoneHandler;
use Amazium\SampleApp\Application\Command\Phone\RegisterPhoneHandlerImpl;
use Amazium\SampleApp\Application\Query\Address\AddressDetailsFetcher;
use Amazium\SampleApp\Application\Query\Address\AddressDetailsFetcherImpl;
use Amazium\SampleApp\Application\Query\Address\AddressesForIdentityFetcher;
use Amazium\SampleApp\Application\Query\Address\AddressesForIdentityFetcherImpl;
use Amazium\SampleApp\Application\Query\Address\AddressesForOverviewFetcher;
use Amazium\SampleApp\Application\Query\Address\AddressesForOverviewFetcherImpl;
use Amazium\SampleApp\Application\Query\Address\AddressesWithoutIdentityFetcher;
use Amazium\SampleApp\Application\Query\Address\AddressesWithoutIdentityFetcherImpl;
use Amazium\SampleApp\Application\Query\Address\DefaultAddressFetcherFactory;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountDetailsFetcher;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountDetailsFetcherImpl;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountsForIdentityFetcher;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountsForIdentityFetcherImpl;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountsForOverviewFetcher;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountsForOverviewFetcherImpl;
use Amazium\SampleApp\Application\Query\BankAccount\DefaultBankAccountFetcherFactory;
use Amazium\SampleApp\Application\Query\Card\CardDetailsFetcher;
use Amazium\SampleApp\Application\Query\Card\CardDetailsFetcherImpl;
use Amazium\SampleApp\Application\Query\Card\CardsForIdentityFetcher;
use Amazium\SampleApp\Application\Query\Card\CardsForIdentityFetcherImpl;
use Amazium\SampleApp\Application\Query\Card\CardsForOverviewFetcher;
use Amazium\SampleApp\Application\Query\Card\CardsForOverviewFetcherImpl;
use Amazium\SampleApp\Application\Query\Card\DefaultCardFetcherFactory;
use Amazium\SampleApp\Application\Query\Document\DefaultDocumentFetcherFactory;
use Amazium\SampleApp\Application\Query\Document\DocumentDetailsFetcher;
use Amazium\SampleApp\Application\Query\Document\DocumentDetailsFetcherImpl;
use Amazium\SampleApp\Application\Query\Document\DocumentsForIdentityFetcher;
use Amazium\SampleApp\Application\Query\Document\DocumentsForIdentityFetcherImpl;
use Amazium\SampleApp\Application\Query\Document\DocumentsForOverviewFetcher;
use Amazium\SampleApp\Application\Query\Document\DocumentsForOverviewFetcherImpl;
use Amazium\SampleApp\Application\Query\Identity\DefaultIdentityFetcherFactory;
use Amazium\SampleApp\Application\Query\Identity\IdentitiesForOverviewFetcher;
use Amazium\SampleApp\Application\Query\Identity\IdentitiesForOverviewFetcherImpl;
use Amazium\SampleApp\Application\Query\Identity\IdentityDetailsFetcher;
use Amazium\SampleApp\Application\Query\Identity\IdentityDetailsFetcherImpl;
use Amazium\SampleApp\Application\Query\Phone\DefaultPhoneFetcherFactory;
use Amazium\SampleApp\Application\Query\Phone\PhoneDetailsFetcher;
use Amazium\SampleApp\Application\Query\Phone\PhoneDetailsFetcherImpl;
use Amazium\SampleApp\Application\Query\Phone\PhonesForIdentityFetcher;
use Amazium\SampleApp\Application\Query\Phone\PhonesForIdentityFetcherImpl;
use Amazium\SampleApp\Application\Query\Phone\PhonesForOverviewFetcher;
use Amazium\SampleApp\Application\Query\Phone\PhonesForOverviewFetcherImpl;
use Amazium\SampleApp\Domain\Repository\Address as AddressRepository;
use Amazium\SampleApp\Domain\Repository\BankAccount as BankAccountRepository;
use Amazium\SampleApp\Domain\Repository\Card as CardRepository;
use Amazium\SampleApp\Domain\Repository\Document as DocumentRepository;
use Amazium\SampleApp\Domain\Repository\Identity as IdentityRepository;
use Amazium\SampleApp\Domain\Repository\Phone as PhoneRepository;
use Amazium\SampleApp\Infrastructure\Db\Repository\Address as AddressDbRepository;
use Amazium\SampleApp\Infrastructure\Db\Repository\BankAccount as BankAccountDbRepository;
use Amazium\SampleApp\Infrastructure\Db\Repository\Card as CardDbRepository;
use Amazium\SampleApp\Infrastructure\Db\Repository\Document as DocumentDbRepository;
use Amazium\SampleApp\Infrastructure\Db\Repository\Identity as IdentityDbRepository;
use Amazium\SampleApp\Infrastructure\Db\Repository\Phone as PhoneDbRepository;
use Amazium\SampleApp\UI\Web\Page\Address\Activate as AddressActivatePage;
use Amazium\SampleApp\UI\Web\Page\Address\Create as AddressCreatePage;
use Amazium\SampleApp\UI\Web\Page\Address\Destroy as AddressDestroyPage;
use Amazium\SampleApp\UI\Web\Page\Address\Edit as AddressEditPage;
use Amazium\SampleApp\UI\Web\Page\Address\Index as AddressIndexPage;
use Amazium\SampleApp\UI\Web\Page\Address\Show as AddressShowPage;
use Amazium\SampleApp\UI\Web\Page\Address\Store as AddressStorePage;
use Amazium\SampleApp\UI\Web\Page\Address\Update as AddressUpdatePage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Activate as BankAccountActivatePage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Create as BankAccountCreatePage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Destroy as BankAccountDestroyPage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Edit as BankAccountEditPage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Index as BankAccountIndexPage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Show as BankAccountShowPage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Store as BankAccountStorePage;
use Amazium\SampleApp\UI\Web\Page\BankAccount\Update as BankAccountUpdatePage;
use Amazium\SampleApp\UI\Web\Page\Card\Activate as CardActivatePage;
use Amazium\SampleApp\UI\Web\Page\Card\Create as CardCreatePage;
use Amazium\SampleApp\UI\Web\Page\Card\Destroy as CardDestroyPage;
use Amazium\SampleApp\UI\Web\Page\Card\Edit as CardEditPage;
use Amazium\SampleApp\UI\Web\Page\Card\Index as CardIndexPage;
use Amazium\SampleApp\UI\Web\Page\Card\Show as CardShowPage;
use Amazium\SampleApp\UI\Web\Page\Card\Store as CardStorePage;
use Amazium\SampleApp\UI\Web\Page\Card\Update as CardUpdatePage;
use Amazium\SampleApp\UI\Web\Page\Identity\Activate as IdentityActivatePage;
use Amazium\SampleApp\UI\Web\Page\Identity\Create as IdentityCreatePage;
use Amazium\SampleApp\UI\Web\Page\Identity\Destroy as IdentityDestroyPage;
use Amazium\SampleApp\UI\Web\Page\Identity\Edit as IdentityEditPage;
use Amazium\SampleApp\UI\Web\Page\Identity\Index as IdentityIndexPage;
use Amazium\SampleApp\UI\Web\Page\Identity\Show as IdentityShowPage;
use Amazium\SampleApp\UI\Web\Page\Identity\Store as IdentityStorePage;
use Amazium\SampleApp\UI\Web\Page\Identity\Update as IdentityUpdatePage;
use Amazium\SampleApp\UI\Web\Page\Phone\Activate as PhoneActivatePage;
use Amazium\SampleApp\UI\Web\Page\Phone\Create as PhoneCreatePage;
use Amazium\SampleApp\UI\Web\Page\Phone\Destroy as PhoneDestroyPage;
use Amazium\SampleApp\UI\Web\Page\Phone\Edit as PhoneEditPage;
use Amazium\SampleApp\UI\Web\Page\Phone\Index as PhoneIndexPage;
use Amazium\SampleApp\UI\Web\Page\Phone\Show as PhoneShowPage;
use Amazium\SampleApp\UI\Web\Page\Phone\Store as PhoneStorePage;
use Amazium\SampleApp\UI\Web\Page\Phone\Update as PhoneUpdatePage;

return [
    'aliases' => [
        // Address command handlers
        AbandonAddressHandler::class => AbandonAddressHandlerImpl::class,
        ActivateAddressHandler::class => ActivateAddressHandlerImpl::class,
        AssignAddressToIdentityHandler::class => AssignAddressToIdentityHandlerImpl::class,
        CreateAddressHandler::class => CreateAddressHandlerImpl::class,
        ModifyAddressDetailsHandler::class => ModifyAddressDetailsHandlerImpl::class,

        // Address query fetchers
        AddressDetailsFetcher::class => AddressDetailsFetcherImpl::class,
        AddressesForIdentityFetcher::class => AddressesForIdentityFetcherImpl::class,
        AddressesForOverviewFetcher::class => AddressesForOverviewFetcherImpl::class,
        AddressesWithoutIdentityFetcher::class => AddressesWithoutIdentityFetcherImpl::class,

        // Bank account command handlers
        AbandonBankAccountHandler::class => AbandonBankAccountHandlerImpl::class,
        ActivateBankAccountHandler::class => ActivateBankAccountHandlerImpl::class,
        RequestBankAccountHandler::class => RequestBankAccountHandlerImpl::class,
        ModifyBankAccountDetailsHandler::class => ModifyBankAccountDetailsHandlerImpl::class,

        // Bank Account query fetchers
        BankAccountDetailsFetcher::class => BankAccountDetailsFetcherImpl::class,
        BankAccountsForIdentityFetcher::class => BankAccountsForIdentityFetcherImpl::class,
        BankAccountsForOverviewFetcher::class => BankAccountsForOverviewFetcherImpl::class,

        // Card command handlers
        AbandonCardHandler::class => AbandonCardHandlerImpl::class,
        ActivateCardHandler::class => ActivateCardHandlerImpl::class,
        RequestCardHandler::class => RequestCardHandlerImpl::class,
        ModifyCardDetailsHandler::class => ModifyCardDetailsHandlerImpl::class,

        // Card query fetchers
        CardDetailsFetcher::class => CardDetailsFetcherImpl::class,
        CardsForIdentityFetcher::class => CardsForIdentityFetcherImpl::class,
        CardsForOverviewFetcher::class => CardsForOverviewFetcherImpl::class,

        // Document command handlers
        DeleteDocumentHandler::class => DeleteDocumentHandlerImpl::class,
        ModifyDocumentDetailsHandler::class => ModifyDocumentDetailsHandlerImpl::class,
        ReplaceDocumentHandler::class => ReplaceDocumentHandlerImpl::class,
        UploadDocumentHandler::class => UploadDocumentHandlerImpl::class,

        // Document query fetchers
        DocumentDetailsFetcher::class => DocumentDetailsFetcherImpl::class,
        DocumentsForIdentityFetcher::class => DocumentsForIdentityFetcherImpl::class,
        DocumentsForOverviewFetcher::class => DocumentsForOverviewFetcherImpl::class,

        // Identity command handlers
        AbandonIdentityHandler::class => AbandonIdentityHandlerImpl::class,
        ActivateIdentityHandler::class => ActivateIdentityHandlerImpl::class,
        CreateIdentityHandler::class => CreateIdentityHandlerImpl::class,
        ModifyIdentityDetailsHandler::class => ModifyIdentityDetailsHandlerImpl::class,

        // Identity query fetchers
        IdentityDetailsFetcher::class => IdentityDetailsFetcherImpl::class,
        IdentitiesForOverviewFetcher::class => IdentitiesForOverviewFetcherImpl::class,

        // Phone command handlers
        AbandonPhoneHandler::class => AbandonPhoneHandlerImpl::class,
        ActivatePhoneHandler::class => ActivatePhoneHandlerImpl::class,
        ModifyPhoneDetailsHandler::class => ModifyPhoneDetailsHandlerImpl::class,
        RegisterPhoneHandler::class => RegisterPhoneHandlerImpl::class,

        // Phone query fetchers
        PhoneDetailsFetcher::class => PhoneDetailsFetcherImpl::class,
        PhonesForIdentityFetcher::class => PhonesForIdentityFetcherImpl::class,
        PhonesForOverviewFetcher::class => PhonesForOverviewFetcherImpl::class,

        // Repositories
        AddressRepository::class => AddressDbRepository::class,
        BankAccountRepository::class => BankAccountDbRepository::class,
        CardRepository::class => CardDbRepository::class,
        DocumentRepository::class => DocumentDbRepository::class,
        IdentityRepository::class => IdentityDbRepository::class,
        PhoneRepository::class => PhoneDbRepository::class,
    ],
    'factories' => [
        // Address command handlers
        AbandonAddressHandlerImpl::class => DefaultAddressHandlerFactory::class,
        ActivateAddressHandlerImpl::class => DefaultAddressHandlerFactory::class,
        AssignAddressToIdentityHandlerImpl::class => DefaultAddressHandlerFactory::class,
        CreateAddressHandlerImpl::class => DefaultAddressHandlerFactory::class,
        ModifyAddressDetailsHandlerImpl::class => DefaultAddressHandlerFactory::class,

        // Address query fetchers
        AddressDetailsFetcherImpl::class => DefaultAddressFetcherFactory::class,
        AddressesForIdentityFetcherImpl::class => DefaultAddressFetcherFactory::class,
        AddressesForOverviewFetcherImpl::class => DefaultAddressFetcherFactory::class,
        AddressesWithoutIdentityFetcherImpl::class => DefaultAddressFetcherFactory::class,

        // Bank account command handlers
        AbandonBankAccountHandlerImpl::class => DefaultBankAccountHandlerFactory::class,
        ActivateBankAccountHandlerImpl::class => DefaultBankAccountHandlerFactory::class,
        RequestBankAccountHandlerImpl::class => DefaultBankAccountHandlerFactory::class,
        ModifyBankAccountDetailsHandlerImpl::class => DefaultBankAccountHandlerFactory::class,

        // Bank Account query fetchers
        BankAccountDetailsFetcherImpl::class => DefaultBankAccountFetcherFactory::class,
        BankAccountsForIdentityFetcherImpl::class => DefaultBankAccountFetcherFactory::class,
        BankAccountsForOverviewFetcherImpl::class => DefaultBankAccountFetcherFactory::class,

        // Card command handlers
        AbandonCardHandlerImpl::class => DefaultCardHandlerFactory::class,
        ActivateCardHandlerImpl::class => DefaultCardHandlerFactory::class,
        RequestCardHandlerImpl::class => DefaultCardHandlerFactory::class,
        ModifyCardDetailsHandlerImpl::class => DefaultCardHandlerFactory::class,

        // Card query fetchers
        CardDetailsFetcherImpl::class => DefaultCardFetcherFactory::class,
        CardsForIdentityFetcherImpl::class => DefaultCardFetcherFactory::class,
        CardsForOverviewFetcherImpl::class => DefaultCardFetcherFactory::class,

        // Document command handlers
        DeleteDocumentHandlerImpl::class => DefaultDocumentHandlerFactory::class,
        ModifyDocumentDetailsHandlerImpl::class => DefaultDocumentHandlerFactory::class,
        ReplaceDocumentHandlerImpl::class => DefaultDocumentHandlerFactory::class,
        UploadDocumentHandlerImpl::class => DefaultDocumentHandlerFactory::class,

        // Document query fetchers
        DocumentDetailsFetcherImpl::class => DefaultDocumentFetcherFactory::class,
        DocumentsForIdentityFetcherImpl::class => DefaultDocumentFetcherFactory::class,
        DocumentsForOverviewFetcherImpl::class => DefaultDocumentFetcherFactory::class,

        // Identity command handlers
        AbandonIdentityHandlerImpl::class => DefaultIdentityHandlerFactory::class,
        ActivateIdentityHandlerImpl::class => DefaultIdentityHandlerFactory::class,
        CreateIdentityHandlerImpl::class => DefaultIdentityHandlerFactory::class,
        ModifyIdentityDetailsHandlerImpl::class => DefaultIdentityHandlerFactory::class,

        // Identity query fetchers
        IdentityDetailsFetcherImpl::class => DefaultIdentityFetcherFactory::class,
        IdentitiesForOverviewFetcherImpl::class => DefaultIdentityFetcherFactory::class,

        // Phone command handlers
        AbandonPhoneHandlerImpl::class => DefaultPhoneHandlerFactory::class,
        ActivatePhoneHandlerImpl::class => DefaultPhoneHandlerFactory::class,
        ModifyPhoneDetailsHandlerImpl::class => DefaultPhoneHandlerFactory::class,
        RegisterPhoneHandlerImpl::class => DefaultPhoneHandlerFactory::class,

        // Phone query fetchers
        PhoneDetailsFetcherImpl::class => DefaultPhoneFetcherFactory::class,
        PhonesForIdentityFetcherImpl::class => DefaultPhoneFetcherFactory::class,
        PhonesForOverviewFetcherImpl::class => DefaultPhoneFetcherFactory::class,

        // Repositories
        AddressDbRepository::class => DefaultEngineRepositoryFactory::class,
        BankAccountDbRepository::class => DefaultEngineRepositoryFactory::class,
        CardDbRepository::class => DefaultEngineRepositoryFactory::class,
        DocumentDbRepository::class => DefaultEngineRepositoryFactory::class,
        IdentityDbRepository::class => DefaultEngineRepositoryFactory::class,
        PhoneDbRepository::class => DefaultEngineRepositoryFactory::class,

        // Address pages
        AddressIndexPage::class => PageFactory::class,
        AddressCreatePage::class => PageFactory::class,
        AddressStorePage::class => PageFactory::class,
        AddressEditPage::class => PageFactory::class,
        AddressUpdatePage::class => PageFactory::class,
        AddressShowPage::class => PageFactory::class,
        AddressDestroyPage::class => PageFactory::class,
        AddressActivatePage::class => PageFactory::class,

        // BankAccount pages
        BankAccountIndexPage::class => PageFactory::class,
        BankAccountCreatePage::class => PageFactory::class,
        BankAccountStorePage::class => PageFactory::class,
        BankAccountEditPage::class => PageFactory::class,
        BankAccountUpdatePage::class => PageFactory::class,
        BankAccountShowPage::class => PageFactory::class,
        BankAccountDestroyPage::class => PageFactory::class,
        BankAccountActivatePage::class => PageFactory::class,

        // Card pages
        CardIndexPage::class => PageFactory::class,
        CardCreatePage::class => PageFactory::class,
        CardStorePage::class => PageFactory::class,
        CardEditPage::class => PageFactory::class,
        CardUpdatePage::class => PageFactory::class,
        CardShowPage::class => PageFactory::class,
        CardDestroyPage::class => PageFactory::class,
        CardActivatePage::class => PageFactory::class,

        // Identity pages
        IdentityIndexPage::class => PageFactory::class,
        IdentityCreatePage::class => PageFactory::class,
        IdentityStorePage::class => PageFactory::class,
        IdentityEditPage::class => PageFactory::class,
        IdentityUpdatePage::class => PageFactory::class,
        IdentityShowPage::class => PageFactory::class,
        IdentityDestroyPage::class => PageFactory::class,
        IdentityActivatePage::class => PageFactory::class,

        // Phone pages
        PhoneIndexPage::class => PageFactory::class,
        PhoneCreatePage::class => PageFactory::class,
        PhoneStorePage::class => PageFactory::class,
        PhoneEditPage::class => PageFactory::class,
        PhoneUpdatePage::class => PageFactory::class,
        PhoneShowPage::class => PageFactory::class,
        PhoneDestroyPage::class => PageFactory::class,
        PhoneActivatePage::class => PageFactory::class,
    ],
];
